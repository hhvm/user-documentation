The following example gets the first value from a `Map`. An empty `Map` will return `null` as its first value.

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};
\var_dump($m->firstValue());

$m = Map {};
\var_dump($m->firstValue());
```
