This example shows how to create a `Vector` from various `Traversable`s:

```basic-usage.php
// Create a new Vector from an array
$v = new Vector(varray['red', 'green', 'blue', 'yellow']);
\var_dump($v);

// Create a new Vector from a Set
$v = new Vector(Set {'red', 'green', 'blue', 'yellow'});
\var_dump($v);

// Create a new Vector from the values of a Map
$v = new Vector(Map {
  'red' => 'red',
  'green' => 'green',
  'blue' => 'blue',
  'yellow' => 'yellow',
});
\var_dump($v);
```

This example shows how passing `null` to the constructor creates an empty `Vector`:

```null-empty.php
// An empty Vector is created if null is provided
$v = new Vector(null);
\var_dump($v);
```
