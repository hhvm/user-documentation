```basic-usage.hack
$result = Str\replace_ci("example_string", "string", "replacement");
echo($result);
//result: example_replacement

$result = Str\replace_ci("example_string", "STRING", "replacement");
echo($result);
//result: example_replacement

$result = Str\replace_ci("example_string", "uncontained", "replacement");
echo($result);
//result: example_string
```