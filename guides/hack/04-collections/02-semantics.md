# Collection Semantics

In general, Hack collections should be your first choice when deciding between them and arrays for new code. They provide the readability, performance and type-checkablity needed, without sacrificing much in terms of flexibility.

That said, there is one key area where you must be cognizant of the differences between collections and arrays.

## Reference Semantics

Hack collections have *reference semantics*. This means that a collection is treated like an object, and modifications made to a collection will affect any collections that were assigned or somehow copied to it. 

Arrays have *value semantics*. Thus, a modification to an array will have no affect to an array that were assigned or somehow copied to it.

@@ semantics-examples/reference-vs-value.php @@

The above example shows the difference between reference and value semantics. This is even true across function calls as well.

## Converting Arrays to Collections

The fact that arrays have value semantics and collections have reference semantics is actually very important when converting existing code using arrays to collections.

@@ semantic-examples/converting.php @@

So, if you had some automatic code modifier to convert `array` to `Vector`, your code could break as shown by the example above.

One way to help remedy this is to use `ImmVector` and Vector::immutable()` to make sure that you cannot modify the collection when you pass it to the function.

@@ semantic-examples/converting-immutable.php @@

## Equality on Collections `==`

Collections can be compared for equality.

```
$coll1 == $coll2;
```

Here are the rules:

1. Are the two collections the same type of collection (mutability ignored)? If no, then equality is `false`.
2. Do the two collections have the same number of values (or keys for maps)? If not, then equality is `false`.
3. For vectors and pairs, is the value at each index equal via `==`? If not, then equality is `false`; otherwise, equality is `true`.
4. For sets, is every value in one contained in the other? If not, then equality is `false`; otherwise, equality is `true`.
5. For maps, does every key in one exist in the other via `===`? If not, then equality is `false`. If so, do the identical keys map to equal values in each collection via `==`? If not, then equality is `false`; otherwise equality is `true`.

@@ semantics-examples/equality.php @@

## Identity on Collections `===`

Collections can be compared for identity.

```
$coll1 === $coll2;
```

Identity only evaluates to `true` if the both collections are the same object. Otherwise, it is `false`.

@@ semantics-examples/identity.php @@

## Using `list()`

You can use [`list()`](http://php.net/manual/en/function.list.php) with  `Vector` and `Pair` just like you can with arrays. 

While you can use `list()` with `Map` and `Set` at runtime, the Hack typechecker will throw an error. Note that you must have a zero integer key and subsequent ordered keys for `Map` and `Set`; otherwise you will get an `OutOfBoundsException`.

@@ semantics-examples/list.php @@
