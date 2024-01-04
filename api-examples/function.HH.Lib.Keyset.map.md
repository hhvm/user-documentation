```basic-usage.hack
$result = Keyset\map(keyset[1,2,3,4], $val ==> $val*2);
print_r($result);
//result: keyset[2,4,6,8]

$result = Keyset\map(keyset[1,2,3,4], $val ==> $val);
print_r($result);
//result: keyset[1,2,3,4]
```