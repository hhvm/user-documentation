```basic-usage.hack
$example_set = vec[keyset[1,2,3,4,5],keyset[98, 99]];
$result = Keyset\flatten($example_set);
print_r($result);
//result: keyset[1,2,3,4,5,98,99]

$example_set = vec[vec[1,2,3,4,5,5,5,5]];
$result = Keyset\flatten($example_set);
print_r($result);
//result: keyset[1,2,3,4,5]

$example_set = vec[];
$result = Keyset\flatten($example_set);
print_r($result);
//result: keyset[]
```