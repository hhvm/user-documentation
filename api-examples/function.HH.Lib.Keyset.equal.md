```basic-usage.hack
$result = Keyset\equal(keyset[1,2,3,4], keyset[1,2,3,4]);
print_r($result);
//result: true

$result = Keyset\equal(keyset[1,2,3,4], keyset[4,2,3,1]);
print_r($result);
//result: true

$result = Keyset\equal(keyset[1,2,3,4],  keyset[1,2,3,4,5]);
print_r($result);
//result: false
```