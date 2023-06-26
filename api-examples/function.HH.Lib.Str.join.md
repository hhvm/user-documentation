```basic-usage.hack
$strings= vec["a", "b", "c", "d"];

$joined_string_1 = Str\join($strings, ",");
echo "First string: $joined_string_1 \n";
//Output: First string: a,b,c,d 

$joined_string_2 = Str\join($strings, "-");
echo "Second string: $joined_string_2";
//Output: Second string: a-b-c-d
```