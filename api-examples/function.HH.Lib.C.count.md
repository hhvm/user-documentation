```basic-usage.hack
$strings = vec["a", "b", "c", "d", "e"];
$count_result_1 = C\count($strings);
echo "First count result: $count_result_1\n";
//Output: First count result: 5

$empty_strings = vec[];
$count_result_2 = C\count($empty_strings);
echo "Second count result: $count_result_2\n";
//Output: Second count result: 0
```