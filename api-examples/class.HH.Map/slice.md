```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
  'purple' => '#663399',
};

// Start at key index 1 ('green') and include 3 elements
$m2 = $m->slice(1, 3);

\var_dump($m2);
```
