```basic-usage.hack
$example_vec = vec[vec[1,2,3,4,5],vec[98,99]];
$result = Vec\flatten($example_vec);
print_r($result);
//result: [1,2,3,4,5,98,99]

$example_vec = vec[vec[1,2,3,4,5,98,99]];
$result = Vec\flatten($example_vec);
print_r($result);
//result: [1,2,3,4,5,98,99]

$example_vec = vec[];
$result = Vec\flatten($example_vec);
print_r($result);
//result: []
```