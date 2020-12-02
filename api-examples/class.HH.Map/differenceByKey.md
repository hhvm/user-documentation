This example shows how `differenceByKey` can be used to get a new `Map` with some keys excluded:

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
  'purple' => '#663399',
};

$m2 = $m->differenceByKey(Set {'red', 'green', 'blue'});

\var_dump($m2);
```
