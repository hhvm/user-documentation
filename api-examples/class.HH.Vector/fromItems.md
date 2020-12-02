```basic-usage.php
// Create a new Vector from an array
$v = Vector::fromItems(varray['red', 'green', 'blue', 'yellow']);
\var_dump($v);

// Create a new Vector from a Set
$v = Vector::fromItems(Set {'red', 'green', 'blue', 'yellow'});
\var_dump($v);

// Create a new Vector from the values of a Map
$v = Vector::fromItems(Map {
  'red' => 'red',
  'green' => 'green',
  'blue' => 'blue',
  'yellow' => 'yellow',
});
\var_dump($v);

// An empty Vector is created if null is provided
$v = Vector::fromItems(null);
\var_dump($v);
```
