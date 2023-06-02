```basie-usage.hack
$strings = vec[1,2,3,4,5];
$is_sorted_by_result_1 = C\is_sorted_by($strings, $x ==> $x);
echo "First is_sorted_by result: $is_sorted_by_result_1\n";
//Output: First is_sorted_by result: true

$is_sorted_by_result_2 = C\is_sorted_by($strings, $x ==> -$x);
echo "Second is_sorted_by result: $is_sorted_by_result_2\n";
//Output: Second is_sorted_by result: false
```