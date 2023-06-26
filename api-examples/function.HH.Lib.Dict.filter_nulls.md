```basic-usage.hack
$original_dict = dict["key_1" => null, "key_2" => 2, "key_3" => 3, "key_4" => null, "key_5" => 5];
$dict_after_filter_nulls = Dict\filter_nulls($original_dict);
echo "Dict after filter nulls: \n";
\print_r($dict_after_filter_nulls);
//Output: Dict after filter nulls: 
//dict["key_2" => 2, "key_3" => 3, "key_5" => 5]
```