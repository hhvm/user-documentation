The following example gets the first key from `Map`. An empty `Map` will return `null` as its first key.

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};
\var_dump($m->firstKey());

$m = Map {};
\var_dump($m->firstKey());
```
