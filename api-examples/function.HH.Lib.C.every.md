```basic-usage.hack
$strings = vec["a", "b", "c", "d"];
$predicate_result_1 = C\every($strings, $x ==> $x != "z");
echo "First predicate: $predicate_result_1\n";
//Output: First predicate: true
$predicate_result_2 = C\every($strings, $x ==> $x == "a");
echo "Second predicate: $predicate_result_2\n";
//Output: Second predicate: false
$predicate_result_3 = C\every($strings);
echo "Third predicate: $predicate_result_3\n";
//Output: Third predicate: true
$empty_strings = vec[];
$predicate_result_4 = C\every($empty_strings, $x ==> $x == "a");
echo "Fourth predicate: $predicate_result_4\n";
//Output: Fourth predicate: true
$predicate_result_5 = C\every($empty_strings);
echo "Fifth predicate: $predicate_result_5\n";
//Output: Fifth predicate: true
```