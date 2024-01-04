```basic-usage.hack
$example_vec = vec[100,2,4,1,6];
$result = Vec\sort($example_vec);
print_r($result);
//result: [1,2,4,6,100]

$example_vec = vec[1,2,3,4,5];
$result = Vec\sort($example_vec);
print_r($result);
//result: [1,2,3,4,5]

$example_vec = vec[0,0,0,0,0];
$result = Vec\sort($example_vec);
print_r($result);
//result: [0,0,0,0,0]
```