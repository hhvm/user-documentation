```basic-usage.hack
$example_vec1 = vec[1,2,3,4,5];
$example_vec2 = vec[1,3];

$result = Vec\intersect($example_vec1, $example_vec2);
print_r($result);
//result: [1,3]

$example_vec3 = vec[6,7];
$result = Vec\intersect($example_vec1, $example_vec3);
print_r($result);
//result: []
```