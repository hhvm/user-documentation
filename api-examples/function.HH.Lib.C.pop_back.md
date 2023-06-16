```basic-usage.hack
$strings = vec["a", "b"];
$pop_back_result_1 = C\pop_back(inout $strings);
echo "First pop_back result: $pop_back_result_1\n";
//Output: First pop_back result: b

$empty_strings = vec[];
$pop_back_result_2 = C\pop_back(inout $empty_strings);
$pop_back_result_2_as_string = $pop_back_result_2 ?? "null";
echo "Second pop_back result: $pop_back_result_2_as_string\n";
//Output: Second pop_back result: null
```