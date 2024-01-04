```basic-usage.hack
$result = Keyset\map_with_key(dict[1 => 2, 2 => 4, 3 => 5], ($key, $val) ==> $val*$key);
print_r($result);
//result: keyset[2,8,15]

$result = Keyset\map_with_key(dict[1 => 2, 2 => 4], ($key, $val) ==> $key);
print_r($result);
//result: keyset[1,2]
```