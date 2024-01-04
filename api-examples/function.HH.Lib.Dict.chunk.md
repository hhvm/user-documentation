```basic-usage.hack
$result = Dict\chunk(dict[1 => 2, 2 => 4], 1);
print_r($result);
// result: vec[dict[1=>2], dict[2=>4]]

$result = Dict\chunk(dict[], 1);
print_r($result);
//result: vec[]
```