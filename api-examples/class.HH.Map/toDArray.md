```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
  'purple' => '#663399',
};

$array = $m->toDArray();

\var_dump(\HH\is_any_array($array));
\var_dump($array);
```
