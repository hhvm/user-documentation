```basic-usage.hack
$result = Keyset\filter_nulls(vec<int>[1,2,3,4,null, null]);
print_r($result);
//result: keyset[1,2,3,4]

$result = Keyset\filter_nulls(vec[1,2,3,4]);
print_r($result);
//result: keyset[1,2,3,4]

$result = Keyset\filter_nulls(vec[]);
print_r($result);
//result: keyset[]
```