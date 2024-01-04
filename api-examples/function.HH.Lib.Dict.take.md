```basic-usage.hack
$result = Dict\take(dict[1 => 2, 2 => 4, 3 => 9], 1);
print_r($result);
//dict[1=>2]

$result = Dict\take(dict[], 1);
print_r($result);
//result: dict[]
```