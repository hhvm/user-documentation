### Bringing Collections, Enums, and Shapes to PHP

Collections, Shapes, and Enums together encapsulate a number of features from other languages that have long been desired in PHP, and in Hack you can use them all.

#### What are Collections?

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


#### What are Enums?

Enums are a way to create a type that is composed of a set of potential constant values:

```
enum DayOfWeek: int {
  Sunday = 0;
  Monday = 1;
  Tuesday = 2;
  Wednesday = 3;
  Thursday = 4;
  Friday = 5;
  Saturday = 6;
}
```

Here we see an `enum` called `DayOfWeek` that has a number of constants which all must have `int` values. We could use this `enum` like this:

```
$opening_hours = Vector {
  "9-5",
  "9-5",
  "9-9",
  "9-9",
  "9-9",
  "9-6",
  "12-5",
};

function getOpeningHours(DayOfWeek $x) {
  return $opening_hours->get($x); 
}

echo getOpeningHours(DayOfWeek::Wednesday);
```

and would expect to see `` as the response. 

These `enum` objects have the same benefits of regular constants, such as being able to update a value in multiple locations in code with a single change. As seen above they can also be used as a type, providing the same benefits of any type hint. On top of that, you get to set the boundaries of what that type can be equal to - for an example, compare this PHP version to the Hack example above:

```
$opening_hours = array(
  "9-5",
  "9-5",
  "9-9",
  "9-9",
  "9-9",
  "9-6",
  "12-5",
);

function getOpeningHours($x) {
  return $opening_hours[$x]; 
}

echo getOpeningHours(3);
```

Notice how much easier it is in the first example to read exactly what the intention of the code is, and how the opportunity to supply an out of bounds index to `$opening_hours` is significantly reduced.


#### What are Shapes?

Many languages have a concept of structures or records, but PHP does not. Instead arrays are often co-opted for this purpose:

```
$my_shape = array('id' => null, 'url' => null, 'count' => 0);
$shape_a = $my_shape;
$shape_a['id'] = "573065673A34Y";
$shape_a['url'] = "http://facebook.com";

function foo($x) {
  echo $x['url'];
  // ...
}

foo($shape_a);
```

Shapes were added to Hack in order to bring some structure and type-checking sanity to this use case. In Hack, the example above could be represented like this:

```
type MyShape = shape('id' => string, 'url' => string, 'count' => int);
$shape_a = shape(
  'id' => "573065673A34Y", 
  'url' => "http://facebook.com", 
  'count' => 0
);

function foo(MyShape $x): void {
  echo $x['url'];
  // ...
}

foo($shape_a);
```

Notice how `foo` can depend strongly upon expecting to have a parameter `$x` with a very predictable structure in the Hack example, whereas in the PHP example we are depending on the developer's implicit mental typing. The scope for errors here is significantly reduced, and the code is far more readable and clear.

#### Further Reading

Please read the documentation on [Collections](../collections/introduction.md), [Shapes](../shapes/introduction.md), and [Enums](../enums/introduction.md) for much more detailed information about these features.