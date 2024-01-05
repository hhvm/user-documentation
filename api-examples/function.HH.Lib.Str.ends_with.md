```basic-usage.hack
$result = Str\ends_with("example_string", "string");
echo($result);
//result: true

$result = Str\ends_with("example_string", "STRING");
echo($result);
//result: false

$result = Str\ends_with("example_string", "uncontained");
echo($result);
// result false
```