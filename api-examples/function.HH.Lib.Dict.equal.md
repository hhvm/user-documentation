```basic-usage.hack
$result = Dict\equal(dict[], dict[]);
print_r($result);
//result: true

$result = Dict\equal(dict[1 => 2, 2 => 4], dict[1 => 2, 2 => 4]);
print_r($result);
//result: true

$result = Dict\equal(dict[1 => 2, 2 => 4], dict[1 => 2, 300 => 4]);
print($result);
//result: false

$result = Dict\equal(dict[1 => 2, 2 => 4], dict[1 => 2, 2 => 7000]);
//result: false
```