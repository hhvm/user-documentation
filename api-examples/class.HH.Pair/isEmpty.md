This example shows that a `Pair` can never be empty:

```basic-usage.php
$p = Pair {'foo', -1.5};
\var_dump($p->isEmpty());

$p = Pair {null, -1.5};
\var_dump($p->isEmpty());
```
