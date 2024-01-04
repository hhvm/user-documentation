```basic-usage.hack
$example_vec1 = vec[1,2,3,4,5];
$example_vec2 = vec[11,17,23,44,55];

$result = Vec\zip($example_vec1, $example_vec2);
print_r($result);
//result: [[1, 11], [2,17], [3,23], [4, 44], [5,55]]

$example_vec3 = vec[6,7];
$result = Vec\zip($example_vec1, $example_vec3);
print_r($result);
//result: [[1,6], [2,7]]
```