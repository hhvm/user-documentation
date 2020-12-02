This shows that a `Pair` always has a count of `2`:

```basic-usage.php
$p = Pair {'foo', -1.5};
\var_dump($p->count());

$p = Pair {null, null};
\var_dump($p->count());
```
