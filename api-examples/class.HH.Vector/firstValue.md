The following example gets the first value from `Vector`. An empty `Vector` will return `null` as its first value.

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};
\var_dump($v->firstValue());

$v = Vector {};
\var_dump($v->firstValue());
```
