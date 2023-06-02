```basic-usage.hack
$strings = vec["a", "b"];
$pop_front_result_1 = C\pop_front(inout $strings);
echo "First pop_front result: $pop_front_result_1\n";
//Output: First pop_front result: a

$empty_strings = vec[];
$pop_front_result_2 = C\pop_front(inout $empty_strings);
$pop_front_result_2_as_string = $pop_front_result_2 ?? "null";
echo "Second pop_front result: $pop_front_result_2_as_string\n";
//Output: Second pop_front result: null
```
