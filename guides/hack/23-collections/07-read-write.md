Like arrays, you can use the square bracket syntax (`[]`) to read and write from Hack collections. 

All the links to methods in this guide will generally link to [`Vector`](/hack/reference/class/Vector/), but they apply to [`Map`](/hack/reference/class/Map/), [`Pair`](/hack/reference/class/Pair/) and [`Set`](/hack/reference/class/Set/) too, unless otherwise specified.

## Reading

There are a few ways to read from a collection. You can use `[]`, call methods like [`contains()`](/hack/reference/class/Set/contains/) and [`containsKey()`](/hack/reference/class/Vector/containsKey/) or use functions like [`isset()`](http://php.net/manual/en/function.isset.php) and [`empty()`](http://php.net/manual/en/function.empty.php).

### Square bracket Syntax  `[]`

You can use square bracket syntax to read from collections.

```
echo $coll[key];
```

@@ read-write-examples/read-square-bracket.php @@

`Set`s do not have keys, so it is a bit strange to use the square bracket syntax for reading, although you can do it at runtime. The Hack typechecker will throw an error, however. You basically replace `key` above with the value in the set you are looking for. Since it is confusing, it is just better to use [`Set::contains()`](/hack/reference/class/Set/contains/) instead.

@@ read-write-examples/read-square-bracket-set.php.type-errors @@

If you use square brackets to read from a collection and the key does not exist in the collection (or the value in the case of a [`Set`](/hack/reference/class/Set/)), then an [`OutOfBoundsException`](http://php.net/manual/en/class.outofboundsexception.php) is thrown.

@@ read-write-examples/read-out-of-bounds.php.type-errors @@

### Retrieving Functions

In addition to using square bracket syntax `[]` to get a value from a collection, there are methods on [`Vector`](/hack/reference/class/Vector/), [`Map`](/hack/reference/class/Map/) and [`Pair`](/hack/reference/class/Pair/) to, given a key, get a value. Since a [`Set`](/hack/reference/class/Set/) does not have keys, these methods do not apply.

- [`at()`](/hack/reference/class/Vector/at/) retrieves the value at the specified key; if the provided key is not found, an [`OutOfBoundsException`](http://php.net/manual/en/class.outofboundsexception.php) is thrown.
- [`get()`](/hack/reference/class/Vector/get/) retrieves the values at the specified key; if the provided key is not found, `null` is returned. Use [`get()`](/hack/reference/class/Vector/get/) to safely try to get a value from a key that possibly does not exist.

### Containing Functions

To test whether a key exists in a [`Vector`](/hack/reference/class/Vector/), [`Map`](/hack/reference/class/Map/) or [`Pair`](/hack/reference/class/Pair/), you can also use the [`containsKey()`](/hack/reference/class/Vector/containsKey/) method. Using [`containsKey()`](/hack/reference/class/Vector/containsKey/) as opposed to `[]` allows you to avoid the possibility of an [`OutOfBoundsException`](http://php.net/manual/en/class.outofboundsexception.php) being thrown.

For a [`Set`](/hack/reference/class/Set/), use [`contains()`](/hack/reference/class/Set/contains/) to check if a value exists in the set.

@@ read-write-examples/read-contains.php @@

**Note**: Using [`contains()`](/hack/reference/class/Vector/contains/) on a [`Vector`](/hack/reference/class/Vector/), [`Map`](/hack/reference/class/Map/) or [`Pair`](/hack/reference/class/Pair/) is synonymous with [`containsKey()`](/hack/reference/class/Vector/containsKey/).

You can also use [`isset()`](http://php.net/manual/en/function.isset.php) or [`empty()`](http://php.net/manual/en/function.empty.php) for key (or value for sets) testing as well. Just note that these functions are not supported in [Hack's strict mode](../typechecker/modes.md).

@@ read-write-examples/read-isset.php @@

**Note**: You can use other array functions like [`array_key_exists()`](http://php.net/manual/en/function.array-key-exists.php), [`array_keys()`](http://php.net/manual/en/function.array-keys.php) with Hack collections as well.

## Writing

### Square Bracket Syntax `[]`

You can append values to [`Vector`s](/hack/reference/class/Vector/) and [`Set`s](/hack/reference/class/Set/) using an empty `[]`. 

For [`Map`s](/hack/reference/class/Map/) you have two ways to append a value using `[]`. 

```
$map[newKey] = value;
$map[] = Pair {key, value};
```

You cannot append a value to a [`Pair`](/hack/reference/class/Pair/). An `InvalidOperationException` will be thrown and the Hack typechecker will throw an error.

@@ read-write-examples/write-square-bracket.php.type-errors @@

### Appending Methods

You can also use [`add()`](/hack/reference/class/Vector/add/) to pass a value to be added to a [`Vector`](/hack/reference/class/Vector/) or [`Set`](/hack/reference/class/Set/). And for [`Map`s](/hack/reference/class/Map/), you can use [`add()`](/hack/reference/class/Map/add/), but pass [`Pair`](/hack/reference/class/Pair/) with a key and value.

### Deleting Methods

To remove a value from a [`Vector`](/hack/reference/class/Vector/), use [`removeKey()`](/hack/reference/class/Vector/removeKey/), passing in the index `n` to remove. This will remove that index, the value associated with that index, and finally shift down one all indices `n + 1` to the final index.

To remove a value from a [`Map`](/hack/reference/class/Map/), you also use [`removeKey()`](/hack/reference/class/Map/removeKey/), passing in the key to remove.

To remove a value from a [`Set`](/hack/reference/class/Set/), use [`remove()`](/hack/reference/class/Set/remove/), passing in the value in the set to remove.

You cannot remove values from a [`Pair`](/hack/reference/class/Pair/).

@@ read-write-examples/delete.php @@

**Note**: You can use [`unset()`](http://php.net/manual/en/function.unset.php) on [`Map`](/hack/reference/class/Map/) and [`Set`](/hack/reference/class/Set/), but not on [`Vector`](/hack/reference/class/Vector/). [`Vector`s](/hack/reference/class/Vector/) shift the indices after a removal, but arrays do not, and [`unset()`](http://php.net/manual/en/function.unset.php) was originally meant for arrays.
