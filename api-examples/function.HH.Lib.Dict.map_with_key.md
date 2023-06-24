```basic-usage.hack
$original_dict_1 = dict[1 => 1, 2 => 2, 3 => 3];
$dict_after_map_with_key = Dict\map_with_key($original_dict_1, ($key, $val) ==> $key % 2 === 0 ? $val : $val * 2);
echo "Dict after map with key: \n";
\print_r($dict_after_map_with_key);
//Output: Dict after map with key:
//dict[1 => 2, 2 => 2, 3 => 6]
```