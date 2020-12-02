This example shows how to create a `Set` from various `Traversable`s. Notice that duplicate values in the input `Traversable`s only appear once in the output `Set`.

```basic-usage.php
// Create a new Set from an array
$s = new Set(varray['red', 'green', 'red', 'blue', 'blue', 'yellow']);
\var_dump($s);

// Create a new Set from a Vector
$s = new Set(Vector {'red', 'green', 'red', 'blue', 'blue', 'yellow'});
\var_dump($s);

// Create a new Set from the values of a Map
$s = new Set(Map {
  'red1' => 'red',
  'green' => 'green',
  'red2' => 'red',
  'blue1' => 'blue',
  'blue2' => 'blue',
  'yellow' => 'yellow',
});
\var_dump($s);
```

This example shows how passing `null` to the constructor creates an empty `Set`:

```null-empty.php
// An empty Set is created if null is provided
$s = new Set(null);
\var_dump($s);
```
