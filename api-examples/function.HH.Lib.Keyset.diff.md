```basic-usage.hack
$result = Keyset\diff(keyset[1,2,3,4,5,6], vec[1,2,3]);
print_r($result);
//result: keyset[4,5,6]

$result = Keyset\diff(vec[1,2,3,4,5,6], keyset[]);
print_r($result);
//result: keyset[1,2,3,4,5,6]
```