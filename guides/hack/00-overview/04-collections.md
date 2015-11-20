[Collections](/hack/collections/introduction), [shapes](/hack/shapes/introduction), and [enums](/hack/enums/introduction) together encapsulate a number of features from other languages that have long been desired in PHP, and in Hack you can use them all.

## What are Collections?

When you're developing PHP code, you have one choice for storing a collection of data - arrays. The problem with arrays is that they are very ambiguous about indexing and traversal, and they don't provide enough code clarity for other developers to modify existing work. 

To improve these issues, and to allow for better type-checking, Hack introduces a number of different data structures, which taken together are referred to as Collections:

**Vectors**

`Vector` objects are used to represent an ordered sequence of values (of any type) where the keys are simply `int`s starting at `0`:

```
$a = Vector {'a', 'b', 'c'};
```

`Vector` objects are mutable, that is they can be modified at any time.
   
**Maps**

`Map` objects are used to represent an ordered sequence of values (of any types) that can be keyed to specific `string` or `int` values:

```
$b = Map {
  "a" => 888, 
  "b" => 23, 
  "f" => 0,
};
```

`Map` objects are mutable, and they are iterated over by the order in which items were inserted. 
  
As you can see, `Vector` and `Map` objects are very similar to the existing PHP `array` functionality, but provide more clarity on their purpose, which also means Hack can more efficiently handle them. Other Collections are more complex:
  
**Sets**

`Set` objects are used to represent an ordered collection of *unique* values (of `string` or `int` types only):

```
$c = Set {"A", "B", "C"};
```

If you tried to add another `"B"` value to this `Set`, it would have no effect as that value already exists. `Set` objects are mutable, and they are iterated over only by insertion order.
  
**Pairs**

`Pair` objects are used to represent exactly two values (of any type):

```
$d = Pair {"bar", 898339};
```

You can't modify the `Pair` itself after it has been created (it is immutable), although its contents may be mutable objects.
  
  
`Vector`, `Map`, and `Set` objects also have immutable equivalents called `ImmVector`, `ImmMap`, and `ImmSet` where elements of the objects cannot be added, removed, or overwritten once the object has been created. 


## What are Enums?

Enums are a way to create a type that is composed of a set of potential constant values:

@@ collections-examples/dayofweek-enum.php @@

Here we see an `enum` called `DayOfWeek` that has a number of constants which all must have `int` values. We could use this `enum` like this:

@@ collections-examples/hack-opening-hours.php @@

and would expect to see `9-9` as the response. 

These `enum` objects have the same benefits of regular constants, such as being able to update a value in multiple locations in code with a single change. As seen above they can also be used as a type, providing the same benefits of any type hint. On top of that, you get to set the boundaries of what that type can be equal to - for an example, compare this PHP version to the Hack example above:

@@ collections-examples/php-opening-hours.php @@

Notice how much easier it is in the first example to read exactly what the intention of the code is, and how the opportunity to supply an out of bounds index to `$opening_hours` is significantly reduced.


## What are Shapes?

Many languages have a concept of structures or records, but PHP does not. Instead arrays are often co-opted for this purpose:

@@ collections-examples/php-shape.php @@

Shapes were added to Hack in order to bring some structure and type-checking sanity to this use case. In Hack, the example above could be represented like this:

@@ collections-examples/hack-shape.php @@

Notice how `foo` can depend strongly upon expecting to have a parameter `$x` with a very predictable structure in the Hack example, whereas in the PHP example we are depending on the developer's implicit mental typing. The scope for errors here is significantly reduced, and the code is far more readable and clear.

## Further Reading

Please read the documentation on [Collections](/hack/collections/introduction), [Shapes](/hack/shapes/introduction), and [Enums](/hack/enums/introduction) for much more detailed information about these features.
