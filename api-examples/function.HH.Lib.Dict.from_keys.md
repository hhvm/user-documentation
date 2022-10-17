```basic-usage.hack
$keys = vec[1, 2, 3, 4];
$dict = Dict\from_keys($keys, $x ==> $x + 1);
\print_r($dict);

$values = vec[1, 2, 3, 4];
$dict = Dict\from_keys($keys, $x ==> 5);
\print_r($dict);
```
