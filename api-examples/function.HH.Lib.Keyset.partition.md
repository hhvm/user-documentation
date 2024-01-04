```basic-usage.hack
$result = Keyset\partition(keyset[1,2,3,4], $val ==> $val%2==0);
print_r($result);
//result: vec[keyset[2,4], keyset[1,3]]

$result = Keyset\partition(keyset[1,2,3,4], $val ==> $val==0);
print_r($result);
//result: vec[keyset[], keyset[1,2,3,4]]
```