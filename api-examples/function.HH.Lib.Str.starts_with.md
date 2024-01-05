```basic-usage.hack
$result = Str\starts_with("example_string", "example");
echo($result);
//result: true

$result = Str\starts_with("example_string", "EXAMPLE");
echo($result);
//result: false

$result = Str\starts_with("example_string", "string");
echo($result);
//result: false
```