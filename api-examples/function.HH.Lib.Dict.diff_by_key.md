```basic-usage.hack
$dict_1 = dict["key_1" => 1, "key_2" => 2, "key_3" => 3, "key_4" => 4, "key_5" => 5];
$dict_2 = dict["key_1" => 10];
$dict_3 = dict["key_3" => 11, "key_4" => 12];
$dict_after_diff_by_key = Dict\diff_by_key($dict_1, $dict_2, $dict_3);
echo "Dict after diff by key: \n";
\print_r($dict_after_diff_by_key);
//Output: Dict after diff by key:
//dict["key_2" => 2, "key_5" => 5]
```