```basic-usage.hack
$original_dict = dict["key_1" => 1, "key_2" => 2, "key_3" => 3, "key_4" => 4, "key_5" => 5];
$dicts_after_chunk = Dict\chunk($original_dict, 2);
echo "Dicts after chunk: \n";
\print_r($dicts_after_chunk);
//Output: Dicts after chunk:
//vec[dict["key_1" => 1, "key_2" => 2], dict["key_3" => 3, "key_4" => 4], dict["key_5" => 5]]
```