```basic-usage.hack
$result = Keyset\union(keyset[1,2], vec[4,5] );
print_r($result);
//result: keyset[1,2,4,5]

$result = Keyset\union(keyset[1,2], vec[3,3,4,5] );
print_r($result);
//result: keyset[1,2,3,4,5]
```