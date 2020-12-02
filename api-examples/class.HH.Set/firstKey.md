This example shows that `firstKey` returns the first value in the `Set`. An empty `Set` will return `null` as its first key.

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};
\var_dump($s->firstKey());

$s = Set {};
\var_dump($s->firstKey());
```
