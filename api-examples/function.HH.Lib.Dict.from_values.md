```hack.basic-usage.hack
$values = vec[1, 2, 3, 4];
$dict = Dict\from_values($values, $x ==> $x + 1);
\print_r($dict);

$values = vec[1, 2, 3, 4];
$dict = Dict\from_values($values, $x ==> 5);
\print_r($dict);
```
