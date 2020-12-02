This example shows how to create a `Map` from various `KeyedTraversable`s:

```basic-usage.php
// Create a new string-keyed Map from an associative array
$m = new Map(darray[
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
]);
\var_dump($m);

// Create a new integer-keyed Map from a Vector
$m = new Map(Vector {'red', 'green', 'blue', 'yellow'});
\var_dump($m);
```

This example shows how passing `null` to the constructor creates an empty `Map`:

```null-empty.php
// An empty Map is created if null is provided
$m = new Map(null);
\var_dump($m);
```
