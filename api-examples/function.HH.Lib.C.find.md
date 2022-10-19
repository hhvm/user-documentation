```basic-usage.hack
$strings= vec["a", "b", "c", "d"];
$predicate_string_1 = C\find($strings, $x ==> $x == "b");
echo "First predicate: $predicate_string_1 \n";

$predicate_string_2 = C\find($strings, $x ==> $x == "z");
$predicate_string_2_as_string = $predicate_string_2 ?? "null";
echo "Second predicate: $predicate_string_2_as_string\n";

$repeat_strings= vec["a1", "b", "a2", "d"];
$predicate_string_3 = C\find($repeat_strings, $x ==> ($x == "a1" || $x == "a2"));
echo "Repeat_predicate: $predicate_string_3";
```