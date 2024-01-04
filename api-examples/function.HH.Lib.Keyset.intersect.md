```basic-usage.hack
$example_set1 = keyset[1,2,3,4,5];
$example_set2 = keyset[1,3];

$result = Keyset\intersect($example_set1, $example_set2);
print_r($result);
//result: keyset[1,3]

$example_vec3 = keyset[6,7];
$result = Keyset\intersect($example_set1, $example_vec3);
print_r($result);
//result: keyset[]
```