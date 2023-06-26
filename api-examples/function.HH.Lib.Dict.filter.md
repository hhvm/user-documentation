```basic-usage.hack
$original_dict = dict["key_1" => 1, "key_2" => 2, "key_3" => 3, "key_4" => 4, "key_5" => 5];
$dict_after_filter = Dict\filter($original_dict, $value ==> $value % 2 === 0);
echo "Dict after filter: \n";
\print_r($dict_after_filter);
//Output: Dict after filter: 
//dict["key_2" => 2, "key_4" => 4]
```