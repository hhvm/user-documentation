```basic-usage.hack
$dict = dict["key_1" => "a", "key_2" => "b", "key_3" => "c"];
$predicate_result_1 = C\find_key($dict, $x ==> $x == "a");
echo "First predicate: $predicate_result_1\n";
//Output: First predicate: key_1

$predicate_result_2 = C\find_key($dict, $x ==> $x == "z");
$predicate_result_2_as_string = $predicate_result_2 ?? "null";
echo "Second predicate: $predicate_result_2_as_string\n";
//Output: Second predicate: null

$repeat_dict = dict["key_1" => "a", "key_2" => "b", "key_3" => "c", "key_4" => "a"];
$predicate_result_3 = C\find_key($dict, $x ==> $x == "a");
echo "Repeat_predicate: $predicate_result_3\n";
//Output: Repeat_predicate: key_1
```