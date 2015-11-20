Collections are iterated via `foreach`.

@@ iterating-examples/foreach.php @@

## Caveats

There are a couple of caveats to be aware of when using `foreach` to iterate over a collection.

### Modifying the Collection

Adding or deleting an item from the collection is not allowed and, if tried, will result in an `InvalidOperationException`.

@@ iterating-examples/modifying.php @@

Note that in the example, the actual add or removal will take effect, but the exception will be thrown when we go back to the loop iteration check.

### By Reference

You cannot do a `foreach` by reference with collections. 

```
foreach ($vec as &$val)
```

This will result in a fatal error, not even an exception. 

There is a way to mimic this behavior.

@@ iterating-examples/reference.php @@

Basically, you explicitly pull out the key/value pair of the collection and then modify the value of the key explicitly.
