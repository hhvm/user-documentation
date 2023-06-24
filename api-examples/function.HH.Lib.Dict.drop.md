```basic-usage.hack
$original_dict = dict["key_1" => 1, "key_2" => 2, "key_3" => 3, "key_4" => 4, "key_5" => 5];
$dict_after_drop = Dict\drop($original_dict, 2);
echo "Dict after drop: \n";
\print_r($dict_after_drop);
//Output: Dict after drop:
//dict["key_3" => 3, "key_4" => 4, "key_5" => 5]
```