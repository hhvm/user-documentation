This example shows that `toMap` returns a deep copy of the `Map` `$m`. Mutating the new `Map` `$m2` doesn't affect the original `Map`.

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$m2 = $m->toMap();
$m2->add(Pair {'purple', '#663399'});

\var_dump($m);
\var_dump($m2);
```
