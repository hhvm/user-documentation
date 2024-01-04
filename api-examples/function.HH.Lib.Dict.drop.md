```basic-usage.hack
$result = Dict\drop(dict[1 => 2, 2 => 4, 3 => 9], 1);
print_r($result);
//result: dict[2=>4, 3=>9]

$result = Dict\drop(dict[], 1);
print_r($result);
//result: dict[]
```