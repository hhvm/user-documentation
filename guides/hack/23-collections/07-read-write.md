Like arrays, you can use the square bracket syntax (`[]`) to read and write from Hack collections. 

## Reading

There are a few ways to read from a collection. You can use `[]`, call methods like `Set::contains()` and `Vector::containsKey()` or use functions like `isset()` and `empty()`.

### Square bracket Syntax  `[]`

You can use square bracket syntax to read from collections.

```
echo $coll[$key];
```

@@ read-write-examples/read-square-bracket.php @@

`Set`s do not have keys, so it is a bit strange to use the square bracket syntax for reading, although you can do it at runtime. The Hack typechecker will throw an error, however. You basically replace `$key` above with the value in the set you are looking for. Since it is confusing, it is just better to use `Set::contains()` instead.

@@ read-write-examples/read-square-bracket-set.php.type-errors @@

If you use square brackets to read from a collection and the key does not exist in the collection (or the value in the case of a `Set`), then an `OutOfBoundsException`is thrown.

@@ read-write-examples/read-out-of-bounds.php.type-errors @@

### Retrieving Functions

In addition to using square bracket syntax `[]` to get a value from a collection, there are methods on `Vector`, `Map` and `Pair`  to, given a key, get a value. Since a `Set` does not have keys, these methods do not apply.

- `at()` (e.g., `Vector::at()`) retrieves the value at the specified key; if the provided key is not found, an `OutOfBoundsException` is thrown.
- `get()` (e.g. `Vector::get()`) retrieves the values at the specified key; if the provided key is not found, `null` is returned. Use `get()` to safely try to get a value from a key that possibly does not exist.

### Containing Functions

To test whether a key exists in a `Vector`, `Map` or `Pair`, you can also use the `Vector::containsKey()`, `Map::containsKey()`, and `Pair::containsKey()` methods, respectively. Using the `containsKey()` methods as opposed to `[]` allows you to avoid the possibility of an `OutOfBoundsException` being thrown.

For a `Set`, use `Set::contains()` to check if a value exists in the set.

@@ read-write-examples/read-contains.php @@

**Note**: Using `Map::contains()` is synonymous with `Map::containsKey()`.

You can also use `isset()` or `empty()` for key (or value for sets) testing as well. Just note that these functions are not supported in [Hack's strict mode](../typechecker/modes.md).

@@ read-write-examples/read-isset.php @@

**Note**: You can use other array functions like `array_key_exists()`, `array_keys()` with Hack collections as well.

## Writing

### Square Bracket Syntax `[]`

You can append values to `Vector`s and `Set`s using an empty `[]`. 

For `Map`s you have two ways to append a value using `[]`. 

```
$map[newKey] = value;
$map[] = Pair {key, value};
```

You cannot append a value to a `Pair`. An `InvalidOperationException` will be thrown and the Hack typechecker will throw an error.

@@ read-write-examples/write-square-bracket.php.type-errors @@

### Appending Methods

You can also use `Vector::add()` or `Set::add()` to pass a value to be added to a `Vector` or `Set`, respectively. And for `Map`s, you can use `Map::add()`, but pass `Pair` with a key and value.

### Deleting Methods

To remove a value from a `Vector`, use `Vector::removeKey()`, passing in the index `n` to remove. This will remove that index, the value associated with that index, and finally shift down one all indices `n + 1` to the final index.

To remove a value from a `Map`, you also use `Map::removeKey()`, passing in the key to remove.

To remove a value from a `Set`, use `Set::remove()`, passing in the value in the set to remove.

You cannot remove values from a `Pair`.

@@ read-write-examples/delete.php @@

**Note**: You can use `unset()` on `Map` and `Set`, but not on `Vector`. `Vector`s shift the indices after a removal, but arrays do not, and `unset()` was originally meant for arrays.
