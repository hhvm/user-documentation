```basic-usage.hack
$example_vec = vec[1,2,3,4,5];
$result = Vec\drop($example_vec, 3);
print_r($result);
//result:  [4,5]

$result = Vec\drop($example_vec, 0);
print_r($result);
//result: [1,2,3,4,5] 
```