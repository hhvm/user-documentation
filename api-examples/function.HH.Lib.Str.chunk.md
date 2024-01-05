```basic-usage.hack
$result = Str\chunk("example_string", 5);
print_r($result);
//result: ["examp", "le_st", "ring"]

$result = Str\chunk("example_string", 50);
print_r($result);
//result: ["example_string"]
```