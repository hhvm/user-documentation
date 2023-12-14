```basic-usage.hack
// NOTE: $keys, $values must be the same length
$keys = vec[1,2,3,4,5];
$values = vec[1,4,9,16,25];
$dict = Dict\associate($keys, $values);
\print_r($dict);
//Output: dict[1 => 1, 2 => 4, 3 => 9, 4 => 16, 5 => 25]
```