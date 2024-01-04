```basic-usage.hack
$result = Keyset\filter(keyset[1,2,3,4], $val ==> $val%2==0);
print_r($result);
//result: keyset[2,4]

$result = Keyset\filter(keyset[1,2,3,4], $val ==> $val==0);
print_r($result);
//result: keyset[]

$result = Keyset\filter(keyset[1,2,3,4],  $val ==> $val == $val);
print_r($result);
//result: keyset[1,2,3,4]
```