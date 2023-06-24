```basic-usage.hack
$original_dict_1 = dict[1 => 1, 2 => 2, 3 => 3];
$dict_after_map_keys = Dict\map_keys($original_dict_1, $key ==> $key * 2);
echo "Dict after map keys: \n";
\print_r($dict_after_map_keys);
//Output: Dict after map keys:
//dict[2 => 2, 4 => 2, 6 => 6]

$dict_after_map_keys_with_duplicate = Dict\map_keys($original_dict_1, $key ==> $key % 2);
echo "Dict after map keys with duplicate: \n";
\print_r($dict_after_map_keys_with_duplicate);
//Output: Dict after map keys with duplicate:
//dict[1 => 3, 0 => 2]
```