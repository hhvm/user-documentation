```basic-usage.hack
$example_vec = vec[1,2,3,4,5];
$chunks = Vec\chunk($example_vec, 3);
print_r($chunks);
// result [[1,2,3], [4,5]]
$chunks = Vec\chunk($example_vec, 5);
print_r($chunks);
// result [1,2,3,4,5]
```