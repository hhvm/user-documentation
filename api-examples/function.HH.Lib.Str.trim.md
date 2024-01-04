```basic-usage.hack
$result = Str\trim("example_string    ");
echo($result);
//result: "example_string"

$result = Str\trim("   example_string  ");
echo($result);
//result: "example_string"
```