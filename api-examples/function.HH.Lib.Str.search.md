```basic-usage.hack
$result = Str\search("example_string", "example");
echo($result);
//result: 0

$result = Str\search("example_string", "EXAMPLE");
echo($result);
//result: null

$result = Str\search("example_string", "example", 2); // with offset
echo($result);
//result: null

$result = Str\search("example_string", "uncontained");
echo($result);
//result: null
```