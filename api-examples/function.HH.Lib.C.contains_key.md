```basic-usage.hack
$dict = dict["key_1" => "a", "key_2" => "b"];
$contains_key_result_1 = C\contains_key($dict, "key_1");
echo "First contains key result: $contains_key_result_1\n";
//Output: First contains key result: true

$contains_key_result_2 = C\contains_key($dict, "key_3");
echo "Second contains key result: $contains_key_result_2\n";
//Output: Second contains key result: false

$contains_key_result_3 = C\contains_key($dict, "");
echo "Third contains key result: $contains_key_result_3\n";
//Output: Third contains key result: false
```