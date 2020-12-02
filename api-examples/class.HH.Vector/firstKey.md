The following example gets the first key from `Vector`. An empty `Vector` will return `null` as its first key.

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};
\var_dump($v->firstKey());

$v = Vector {};
\var_dump($v->firstKey());
```
