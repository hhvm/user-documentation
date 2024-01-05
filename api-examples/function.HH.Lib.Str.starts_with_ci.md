```basic-usage.hack
$result = Str\starts_with_ci("example_string", "example");
echo($result);
//result: true

$result = Str\starts_with_ci("example_string", "EXAMPLE");
echo($result);
//result: true

$result = Str\starts_with_ci("example_string", "string");
echo($result);
//result: false
```