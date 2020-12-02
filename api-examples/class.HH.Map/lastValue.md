This example shows how `lastValue()` can be used even when a `Map` may be empty:

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};
\var_dump($m->lastValue());

$m = Map {};
\var_dump($m->lastValue());
```
