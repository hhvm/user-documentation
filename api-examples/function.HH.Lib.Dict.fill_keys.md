```basic-usage.hack
$keys = vec['key_1', 'key_2', 'key_3', 'key_4', "key_5"];
$value = 5;
$dict = Dict\fill_keys($keys, $value);
echo "Dict after fill keys: \n";
\print_r($dict);
//Output: Dict after fill keys:
//dict["key_1" => 5, "key_2" => 5, "key_3" => 5, "key_4" => 5, "key_5" => 5]
```
