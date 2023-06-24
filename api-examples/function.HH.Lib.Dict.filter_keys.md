```basic-usage.hack
$original_dict = dict["key_1" => 1, "key_2" => 2, "key_3" => 3, "key_4" => 4, "key_5" => 5];
$dict_after_filter_keys = Dict\filter_keys($original_dict, $key ==> $key !== "key_4");
echo "Dict after filter keys: \n";
\print_r($dict_after_filter_keys);
//Output: Dict after filter keys: 
//dict["key_1" => 1, "key_2" => 2, "key_3" => 3, "key_5" => 5]
```