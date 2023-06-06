```basie-usage.hack
$strings = vec["a", "b", "c", "d", "e"];
$is_empty_result_1 = C\is_empty($strings);
echo "First is_empty result: $is_empty_result_1\n";
//Output: First is_empty result: false

$empty_strings = vec[];
$is_empty_result_2 = C\is_empty($empty_strings);
echo "Second is_empty result: $is_empty_result_2\n";
//Output: Second is_empty result: true
```
