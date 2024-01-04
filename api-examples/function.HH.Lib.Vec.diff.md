```basic-usage.hack
$example_vec1 = vec[1,2,3,4,5];
$example_vec2 = vec[1,3];

$diffed_vec = Vec\diff($example_vec1, $example_vec2);
print_r($diffed_vec);
// result: [2,4,5]

$example_vec3 = vec[6,7];

$diffed_vec = Vec\diff($example_vec1, $example_vec3);
print_r($diffed_vec);
// result: [1,2,3,4,5] 
```