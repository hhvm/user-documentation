```basic-usage.hack
$result = Keyset\chunk(vec[1,2,3,4,5,6],3);
print_r($result);
//result: [keyset[1,2,3], keyset[4,5,6]]

$result = Keyset\chunk(vec[1,2,2,3,4,5],3);
print_r($result);
//result: [keyset[1,2], keyset[3,4,5]]
```
