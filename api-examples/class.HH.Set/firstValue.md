The following example gets the first value from a `Set`. An empty `Set` will return `null` as its first value.

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};
\var_dump($s->firstValue());

$s = Set {};
\var_dump($s->firstValue());
```
