```basic-usage.hack
$dict = dict["key_1" => "a", "key_2" => "b", "key_3" => "c"];
$last_keyx_result_1 = C\last_keyx($dict);
echo "First last keyx result: $last_keyx_result_1\n";
//Output: First last keyx result: key_3

$empty_dict = dict[];
$last_keyx_result_2 = C\last_keyx($empty_dict);
//Output: Hit a php exception : exception 'InvariantViolationException' with message
//'HH\Lib\C\last_keyx: Expected at least one element.' 
```