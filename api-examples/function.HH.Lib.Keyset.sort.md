```basic-usage.hack
$result = Keyset\sort(keyset[1,200, 5]);
print_r($result);
//result: keyset[1,5,200]

$result = Keyset\sort(keyset[100,2000,3,4]);
print_r($result);
//result: keyset[3,4,100,2000]
```