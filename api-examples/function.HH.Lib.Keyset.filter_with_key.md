```basic-usage.hack
$result = Keyset\filter_with_key(dict[1 => 2, 2 => 4, 3 => 5], ($key, $val) ==> $val%2==0);
print_r($result);
//result: keyset[2,4]

$result = Keyset\filter_with_key(dict[1 => 2, 2 => 4], ($key, $val) ==> $val==0);
print_r($result);
//result: keyset[]

$result = Keyset\filter_with_key(dict[1 => 2, 2 => 4, 3 => 5],  ($key, $val) ==> $val == $val);
print_r($result);
//result: keyset[2,4,5]
```