## WARNING WARNING WARNING

*These runtime options are a migrational feature. This means that they come and go when new hhvm versions are released. Before relying on them, it is recommended to run the given example code. If this does not raise a "Hack Arr Compat Notice" this options is not available in your version of HHVM.*

If you notice that an options doesn't apply anymore and you are running a very modern version of HHVM, please open an issue or pull request against this repository. We'll mark the EOL of that given runtime option in the documentation. We thank you in advance.

The [runtime options](arrays.md#php-arrays-array-varray-and-darray__runtime-options) were briefly introduced in the article on `varray` and `darray`. This article builds upon the information given there.

You can get a list of the runtime options that your current hhvm recognizes from this script.
This relies on the settings being in your `server.ini`.
The output will look something like this.

@@ darray-varray-runtime-options-examples/get_all_runtime_options.php @@

An important note: These settings will not work when you set them at runtime using ini_set(). You must set these in your configuration file or pass them in using the `-dsettinghere=value_here` command line argument when invoking your script from the command line.

## Check implicit varray append

Fullname: hhvm.hack_arr_compat_check_implicit_varray_append

This setting will raise a notice under the following condition.
If it does not raise a warning, this options is not available in your version of hhvm.

@@ darray-varray-runtime-options-examples/hack_arr_compat_check_implicit_varray_append.php @@

A `vec<_>` does not support implicitly appending. You can only append using an empty subscript operator `$x[] = ''` and update using a keyed subscript operator `$x[2] = ''`. The runtime will throw when you use the updating syntax in order to append. `'OutOfBoundsException' with message 'Out of bounds vec access: invalid index 2'`.

A `varray<_>` will, as of now, accept you implicitly appending a key. It will remain a `varray<_>`. This is the only case where writing to a non existant index in a `varray<_>` will not cause the `varray<_>` to escalate to a `darray<_>`. More information about array escalation can be found below. (Has yet to be written.)
