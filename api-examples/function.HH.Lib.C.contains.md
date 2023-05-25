```basic-usage.hack
$strings = vec["a", "b", "c", "d"];
$contains_result_1 = C\contains($strings, "a");
echo "First contains result: $contains_result_1\n";
//Output: First contains result: true

$contains_result_2 = C\contains($strings, "z");
echo "Second contains result: $contains_result_2\n";
//Output: Second contains result: false

$empty_strings = vec[];
$contains_result_3 = C\contains($empty_strings, "a");
echo "Third contains result: $contains_result_3\n";
//Output: Third contains result: false
```