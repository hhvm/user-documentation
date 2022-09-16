```basic-usage.hack
$strings= vec["a", "b", "c", "d"];

$joined_string_1 = Str\join($strings, ",");
echo "First string: $joined_string_1 \n";

$joined_string_2 = Str\join($strings, "-");
echo "Second string: $joined_string_2";
```