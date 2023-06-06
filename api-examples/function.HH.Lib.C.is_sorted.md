```basie-usage.hack
$strings = vec["a", "b", "c", "d", "e"];
$is_sorted_result_1 = C\is_sorted($strings);
echo "First is_sorted result: $is_sorted_result_1\n";
//Output: First is_sorted result: true

$second_strings = vec["a", "b", "a", "d", "e"];
$is_sorted_result_2 = C\is_sorted($second_strings);
echo "Second is_sorted result: $is_sorted_result_2\n";
//Output: Second is_sorted result: false

$empty_strings = vec[];
$is_sorted_result_3 = C\is_sorted($empty_strings);
echo "Third is_sorted result: $is_sorted_result_3\n";
//Output: Third is_sorted result: true
```
