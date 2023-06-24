```basic-usage.hack
$dict = dict["key_1" => "a", "key_2" => "b", "key_3" => "c"];
$keys = Vec\keys($dict);
echo "Keys of the given dict \n";
\print_r($keys);
//Output: Keys of the given dict 
//vec["key_1", "key_2", "key_3"]
```