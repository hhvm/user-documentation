```basic-usage.hack
$result = Str\reverse("example_string");
echo($result);
//result: "gnirts_elpmaxe"

$result = Str\reverse("Example_string");
echo($result);
//result:"gnirts_elpmaxE"

$result = Str\reverse("");
echo($result);
//result: ""
```