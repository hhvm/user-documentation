```basic-usage.hack
$dict = dict["key_1" => "a", "key_2" => "b", "key_3" => "c"];
$last_key_result_1 = C\last_key($dict);
echo "First last key result: $last_key_result_1\n";
//Output: First last key result: key_3

$empty_dict = dict[];
$last_key_result_2 = C\last_key($empty_dict);
$last_key_result_2_as_string = $last_key_result_2 ?? "null";
echo "Second last key result: $last_key_result_2_as_string\n";
//Output: Second last key result: null
```