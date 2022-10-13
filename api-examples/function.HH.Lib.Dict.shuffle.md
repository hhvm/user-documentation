```basic-usage.hack
$keys = vec['k1', 'k2', 'k3', 'k4', 'k5'];
$values = vec[1, 2, 3, 4, 5];
$shuffled = Dict\shuffle($keys, $values);
\print_r($shuffled);

$keys = vec['k1'];
$values = vec[1];
$shuffled = Dict\shuffle($keys, $values);
\print_r($shuffled);
```
