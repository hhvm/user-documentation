```basic-usage.hack
$strings = vec["a", "b", "c", "d"];
$predicate_result_1 = C\any($strings, $x ==> $x == "a");
echo "First predicate: $predicate_result_1\n";
//Output: First predicate: true

$predicate_result_2 = C\any($strings, $x ==> $x == "z");
echo "Second predicate: $predicate_result_2\n";
//Output: Second predicate: false

$predicate_result_3 = C\any($strings);
echo "Third predicate: $predicate_result_3\n";
//Output: Third predicate: true

$empty_strings = vec[];
$predicate_result_4 = C\any($empty_strings, $x ==> $x == "a");
echo "Fourth predicate: $predicate_result_4\n";
//Output: Fourth predicate: false

$predicate_result_5 = C\any($empty_strings);
echo "Fifth predicate: $predicate_result_5\n";
//Output: Fifth predicate: false
```