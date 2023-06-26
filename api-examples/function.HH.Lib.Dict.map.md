```basic-usage.hack
$original_dict_1 = dict["key_1" => 1, "key_2" => 2, "key_3" => 3];
$dict_of_lambda_multiplied_values = Dict\map($original_dict_1, $val ==> $val * 2);
echo "Resulting lambda multiplied dict: \n";
\print_r($dict_of_lambda_multiplied_values);
//Output: Resulting lambda multiplied dict: 
//dict["key_1" => 2, "key_2" => 4, "key_3" => 6]

$original_dict_2 = dict["key_1" => "a", "key_2" => "b", "key_3" => "c"];
$dict_of_function_uppercased_values = Dict\map($original_dict_2, Str\uppercase<>);
echo "Resulting function uppercased dict: \n";
\print_r($dict_of_function_uppercased_values);
//Output: Resulting function uppercased dict:
//dict["key_1" => "A", "key_2" => "B", "key_3" => "C"]
```