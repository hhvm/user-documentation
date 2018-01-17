Collections are iterated via `foreach`.

@@ iterating-examples/foreach.php @@

## Caveats

There are a couple of caveats to be aware of when using `foreach` to iterate over a collection.

### Modifying the Collection

Adding or deleting an item from the collection will not affect iteration:

@@ iterating-examples/modifying.php @@

### By Reference

You cannot do a `foreach` by reference with collections. 

```
foreach ($vec as &$val)
```

This will result in a fatal error, not even an exception. 

There is a way to mimic this behavior.

@@ iterating-examples/reference.php @@

Basically, you explicitly pull out the key/value pair of the collection and then modify the value of the key explicitly.
