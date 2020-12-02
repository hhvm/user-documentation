This example creates new `Vector`s by concatenating the values in a `Map` with `Traversable`s:

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
};

// Create a Vector by concating the values from $m with a Set
$v1 = $m->concat(Set {'#00ff00', '#0000ff'});

// Create a Vector by concating the values from $m with a Vector
$v2 = $m->concat(Vector {'#ffff00', '#663399'});

\var_dump($m->values()); // $m contains the value '#ff0000'
\var_dump($v1); // $v1 contains '#ff0000', '#00ff00', '#0000ff'
\var_dump($v2); // $v2 contains '#ff0000', '#ffff00', '#663399'
```
