```basic-usage.php
$p = Pair {-1.5, null};

$v = $p->filter($value ==> $value !== null);
\var_dump($v);
```
