The string version of a `Pair` is always `"Pair"`:

```basic-usage.php
$p = Pair {-1, 5};
echo $p->__toString()."\n";

$p2 = Pair {'foo', 'bar'};
echo $p2->__toString()."\n";
```
