```basic-usage.hack
$result = Vec\range(1, 10, 1);
print_r($result);
//result: [1,2,3,4,5,6,7,8,9,10]

$result = Vec\range(1, 10, 2);
print_r($result);
//result: [1,3,5,7,9]

$result = Vec\range(1, 10, 3);
print_r($result);
//result: [1,4,7,10]
```