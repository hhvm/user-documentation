```basic-usage.hack
$result = Keyset\take(keyset[1,200, 5], 2);
print_r($result);
//result: keyset[1,200]

$result = Keyset\take(keyset[100,2000,3,4], 0);
print_r($result);
//result: keyset[]
```