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
