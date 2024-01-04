```basic-usage.hack
$example_vec = vec[1,2,3,4,5];
$result = Vec\sample($example_vec, 3);
print_r($result);
//result: [2,5,3] OR any 3 elements

$result = Vec\sample($example_vec, 0);
print_r($result);
//result: []

$result = Vec\sample($example_vec, 5);
print_r($result);
//result: [4,5,2,1,3]; All 5 elements
```