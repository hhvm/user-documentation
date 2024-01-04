```basic-usage.hack
$result = Vec\keys(dict[1 => 100, 33 => 400 ]);
print_r($result);
//result: [1, 33]

$result = Vec\keys(dict[]);
print_r($result);
//result: []
```