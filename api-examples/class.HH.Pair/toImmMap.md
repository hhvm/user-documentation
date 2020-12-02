```basic-usage.php
$p = Pair {'foo', -1.5};

$imm_map = $p->toImmMap();

\var_dump($imm_map is \HH\ImmMap<_, _>);
\var_dump($imm_map);
```
