```basic-usage.hack
$result = Str\slice("example_string", 5);
echo($result);
//result: "le_string"

$result = Str\slice("example_string", 5, 1);
echo($result);
//result: "l"

$result = Str\slice("example_string", 2, 0);
echo($result);
//result: ""

$result = Str\slice("example_string", 1000);
echo($result);
//result: <Throws exception>
```