```basic-usage.hack
$result = Str\contains("example_string", "example");
echo($result);
//result: true 

$result = Str\contains("example_string", "EXAMPLE"); // different case
echo($result);
//result: false

$result = Str\contains("example_string", "example", 2); // with offset
echo($result);
//result: false 

$result = Str\contains("example_string", "uncontained");
echo($result);
//result: false 
```