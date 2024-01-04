```basic-usage.hack
$result = Keyset\keys(dict[1 => 100, 33 => 400 ]);
print_r($result);
//result: keyset[1,33]

$result = Keyset\keys(dict[]);
print_r($result);
//result: keyset[]
```