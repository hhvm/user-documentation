```basic-usage.hack
$result = Dict\merge(dict[1 => 2, 2 => 4], dict[7 => 2, 100 => 4]);
print_r($result);
//result: dict[1=>2, 2=>4, 7=>2, 100=>4]

$result = Dict\merge(dict[1 => 2, 2 => 4], dict[7 => 2, 2 => 100]);
print_r($result);
//result: dict[1=>2, 2=>100, 7=>2]
```