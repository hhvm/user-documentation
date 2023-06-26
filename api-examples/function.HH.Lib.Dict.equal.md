```basic-usage.hack
$dict_1 = dict["key_1" => 1, "key_2" => 2, "key_3" => 3];
$dict_2 = dict["key_1" => 1, "key_2" => 2, "key_3" => 3];
$is_equal_between_1_and_2 =Dict\equal($dict_1, $dict_2);
$is_equal_between_1_and_2_to_string = $is_equal_between_1_and_2 ? "true" : "false";
echo "Is equal_between_1_and_2: $is_equal_between_1_and_2_to_string \n";
//Output: Is equal_between_1_and_2: true 

$dict_3 = dict["key_1" => 1, "key_2" => 2, "key_3" => 5];
$is_equal_between_1_and_3 =Dict\equal($dict_1, $dict_3);
$is_equal_between_1_and_3_to_string = $is_equal_between_1_and_3 ? "true" : "false";
echo "Is equal_between_1_and_3: $is_equal_between_1_and_3_to_string \n";
//Output: Is equal_between_1_and_3: false 
```