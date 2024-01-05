```basic-usage.hack
$result = Str\replace_every_ci("example_string", dict["example"=>"test", "string"=>"value"]);
echo($result);
//result: test_value

$result = Str\replace_every_ci("example_string", dict["EXAMPLE"=>"test", "STRING"=>"value"]);
echo($result);
//result: test_value

$result = Str\replace_every_ci("example_string", dict["uncontained"=>"test", "uncontained_2"=>"value"]);
echo($result);
//result: example_string
```