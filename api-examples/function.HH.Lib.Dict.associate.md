```basic-usage.hack
$keys = vec["key_1", "key_2", "key_3"];
$values = vec[1, 2, 3];
$dict = Dict\associate($keys, $values);
echo "Dict after associate: \n";
\print_r($dict);
//Output: Dict after associate:
//dict["key_1" => 1, "key_2" => 2, "key_3" => 3]
```