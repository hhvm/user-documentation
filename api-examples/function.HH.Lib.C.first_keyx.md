```basic-usage.hack
$dict = dict["key_1" => "a", "key_2" => "b", "key_3" => "c"];
$first_keyx_result_1 = C\first_keyx($dict);
echo "First first keyx result: $first_keyx_result_1\n";
//Output: First first keyx result: key_1

$empty_dict = dict[];
$first_keyx_result_2 = C\first_keyx($empty_dict);
//Output: Hit a php exception : exception 'InvariantViolationException' with message 
//'HH\Lib\C\first_keyx: Expected at least one element.' 
```