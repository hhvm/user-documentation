```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};

$imm_map = $s->toImmMap();

\var_dump($imm_map is \HH\ImmMap<_, _>);
\var_dump($imm_map);
```
