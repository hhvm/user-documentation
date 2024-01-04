```basic-usage.hack
$result = Vec\fill(2, 100);
print_r($result);
//result: [100, 100]

$result = Vec\fill(0, 10);
print_r($result);
//result: []

$result = Vec\fill(5, 1);
print_r($result);
//result: [1,1,1,1,1]
```