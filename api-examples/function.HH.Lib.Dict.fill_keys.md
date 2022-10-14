```basic-usage.hack
$keys = vec['k1', 'k2', 'k3', 'k4'];
$value = 5;
$dict = Dict\fill_keys($keys, $value);
\print_r($dict);
```
