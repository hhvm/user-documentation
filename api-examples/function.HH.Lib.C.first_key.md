```basic-usage.hack
$dict = dict["key_1" => "a", "key_2" => "b", "key_3" => "c"];
$first_key_result_1 = C\first_key($dict);
echo "First first key result: $first_key_result_1\n";
//Output: First first key result: key_1

$empty_dict = dict[];
$first_key_result_2 = C\first_key($empty_dict);
$first_key_result_2_as_string = $first_key_result_2 ?? "null";
echo "Second first key result: $first_key_result_2_as_string\n";
//Output: Second first key result: null
```