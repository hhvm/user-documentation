```basic-usage.hack
$result = Dict\sort(dict[1 => 2000, 2 => 1000, 3 => 9]);
print_r($result);
//result: dict[3=>9, 2=>1000, 1=>2000]

$result = Dict\sort(dict[]);
print_r($result);
//result: dict[]
```