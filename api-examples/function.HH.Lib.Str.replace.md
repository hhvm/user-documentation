```basic-usage.hack
$result = Str\replace("example_string", "string", "replacement");
echo($result);
//result: "example_replacement"

$result = Str\replace("example_string", "STRING", "replacement");
echo($result);
//result: "example_string"

$result = Str\replace("example_string", "uncontained", "replacement");
echo($result);
//result: "example_string"
```