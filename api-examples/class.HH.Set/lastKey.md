This example shows that `lastKey` returns the last value in the `Set`. An empty `Set` will return `null` as its last key/value.

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};
\var_dump($s->lastKey());

$s = Set {};
\var_dump($s->lastKey());
```
