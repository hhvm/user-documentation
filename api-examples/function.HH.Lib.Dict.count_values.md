```basic-usage.hack
$result = Dict\count_values(vec[1,2,2,3,3,3]);
print_r($result);
//result: dict[1=>1, 2=>2, 3=>3]

$result = Dict\count_values(vec[0,0,0,0,0]);
print_r($result);
//result: dict[0=>5]
```