```basic-usage.hack
$result = Str\ends_with_ci("example_string", "string");
echo($result);
//result: true
$result = Str\ends_with_ci("example_string", "STRING");
echo($result);
//result: true
$result = Str\ends_with_ci("example_string", "uncontained");
echo($result);
//result: false
```