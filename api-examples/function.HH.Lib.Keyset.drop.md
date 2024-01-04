```basic-usage.hack
$result = Keyset\drop(keyset[1,2,3,4,5,6], 3);
print_r($result);
//result: keyset[4,5,6]

$result = Keyset\drop(vec[1,2,3,4,5,6], 0);
print_r($result);
//result: keyset[1,2,3,4,5,6]
```
