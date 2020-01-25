## WARNING WARNING WARNING

*These runtime options are a migrational feature. This means that they come and go when new hhvm versions are released. Before relying on them, it is recommended to run the given example code. If this does not raise a "Hack Arr Compat Notice" this options is not available in your version of HHVM.*

If you notice that an option doesn't apply anymore and you are running a very modern version of HHVM, please open an issue or pull request against this repository. We'll mark the EOL date of that given runtime option in the documentation. We thank you in advance.

The [runtime options](arrays.md#php-arrays-array-varray-and-darray__runtime-options) were briefly introduced in the article on `varray<_>` and `darray<_, _>`. This article builds upon the information given there.

You can get a list of the runtime options that your current hhvm recognizes from this script.
This relies on the settings being in your `server.ini`.
The output will look something like this.

@@ darray-varray-runtime-options-examples/get_all_runtime_options.php @@

An important note: These settings will not work when you set them at runtime using ini_set(). You must set these in your configuration file or pass them in using the `-dsettinghere=value_here` command line argument when invoking your script from the command line.

## Check implicit varray append

Fullname: hhvm.hack_arr_compat_check_implicit_varray_append

This setting will raise a notice under the following condition.
If it does not raise a warning, this option is not available in your version of hhvm.

@@ darray-varray-runtime-options-examples/hack_arr_compat_check_implicit_varray_append.php @@

A `vec<_>` does not support implicitly appending. You can only append using an empty subscript operator `$x[] = ''` and update using a keyed subscript operator `$x[2] = ''`. The runtime will throw when you use the updating syntax in order to append. `'OutOfBoundsException' with message 'Out of bounds vec access: invalid index 2'`.

A `varray<_>` will, as of now, accept you implicitly appending a key. It will remain a `varray<_>`. This is the only case where writing to a non existant index in a `varray<_>` will not cause the `varray<_>` to escalate to a `darray<_, _>`. More information about array escalation can be found below.

## Check varray promote

Fullname: hhvm.hack_arr_compat_check_varray_promote

This setting will raise a notice until the following condition.
If it does not raise a warning, this option is not available in your version of hhvm.

@@ darray-varray-runtime-options-examples/hack_arr_compat_check_varray_promote.php @@

These situations are sadly very common in grandfathered PHP code.

The first situation, writing to a key out of bounds, is not permitted on a `vec<_>`. It throws and `OutOfBoundsException`. A `vec<_>` will always maintain the keys 0, 1, 2, ... and will therefore have to refuse to create the new index on the fly.

There are two distinct intents that the programmer may have had when writing this code.

 - The keys are actually useful data.
 - The keys are meant to be indexes 0, 1, 2 and the programmer assumed that he or she was writing in-bounds.

The first case is usually pretty easy to fix. If it looks like the keys are userids, timestamps, or alike, `varray<_>` isn't the right type. Migrate the code to use `darray<_, current_value_type>`. You'll have to figure out the keytype from context.

The second case is far less easy to give a clear fix for.

 - Chances are that there is a nearby `C\count()` doing a bounds check that might be defective.
 - Is the array being filled out of order? Are all the indexes between 0 and the greatest index used after this procedure? You might be tempted to make the fill happen in order, but that will change the order that the elements are iterated over in a foreach.

The second situation, calling unset on an element of a `varray<_>`, can have multiple intends too.

 - If the T is a nullable type, the programmer might have meant to write `null` to the index. This is more common in code written before hhvm4.
 - The programmer does not care about the keys. The array is merely a meant to be used as a `KeyedContainer<not_important, T>` and he or she just meant to remove the value from the `KeyedContainer<_, _>`.
 - The programmer intended to unset the last index.

The first case is most likely a confusion caused by a removed behavior of all legacy arrays. Before hhvm 4 accessing an key that wasn't present would log a notice and return null. An unset on an array would under these circumstances act very similarly to explicitly setting to value to null. This is however quite tricky to do right if this array is being passed around the program a lot. An unset key is actually removed from the array. This means that `C\contains_key()` will return `false`, `idx()` will return its default argument, and `??` will evaluate to the RHS. However, explicitly setting the value to `null` does not remove the key from the array. This means that `C\contains_key()` returns `true`, `idx()` will return the `null`, but `??` will be unaffected.

The second usecase is not met by Hack arrays. There is no `Container<_>` type that allows you to append to the end and remove things by index (except for `keyset<_>`, but that has a constraint value type). You can however emulate this behavior using a `varray<_>` or `vec<_>`. Removing the first key can be done using `Vec\drop($x, 1)`. Removing the last key can be done using `Vec\take($x, C\count($x) - 2)`. Removing a key from the middle can be done with the slightly unwieldly `Vec\concat(Vec\take($x, $key), Vec\drop($x, $key + 2))`. All of these will rekey the array. Any values after the key will be shifted down. This does however have a computational complexity of `O(n)`. If you need to remove a lot of keys from the middle that are next to eachother, use `Vec\slice()` instead of `Vec\take()` and `Vec\drop()` to save some resources. If you need to remove a ton of arbitrary keys, it might be better to `dict($x)`, unset on the `dict<_, _>` and rekey it back to a `varray<_>` using `varray()` or `array_values()` depending on your hhvm version.

The third usecase used to be valid Hack. Unsetting the last index of a `varray<_>` or `vec<_>` was allowed and acted like an <oss>\array_pop()</oss><facebook>C\fb\pop_back()</facebook> (THIS IS NOT ACUTALLY VALID SYNTAX FOR DISABLING TEXT IN OSS OR FB). This will currently not generate a warning, but it is unclear to me if this will continue to be allowed. The typechecker already raises a typeerror when you use unset on a non dictionary/hashmap like array type.

The third situation, writing to a string key, is always a mistake.

If this is a string literal, the actual type is most likely `darray<_, _>`. If this is an intergral string coming from an untyped function, it is worth investigating casting the value to an int.