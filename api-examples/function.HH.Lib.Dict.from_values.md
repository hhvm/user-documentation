```hack.basic-usage.hack
$original_dict_1 = dict[1 => 1, 2 => 2, 3 => 3];
$from_values_dict_1 = Dict\from_values($original_dict_1, $x ==> $x + 1);
echo "Resulting from values dict 1: \n";
\print_r($from_values_dict_1);
//Output: Resulting from values dict 1:
//dict[2 => 1, 3 => 2, 4 => 3]

$original_dict_2 = dict[1 => 1, 2 => 2, 3 => 3];
$from_values_repeat_value_dict_2 = Dict\from_values($original_dict_2, $x ==> $x * 0);
echo "Resulting from repeat values dict 2: \n";
\print_r($from_values_repeat_value_dict_2);
//Output: Resulting from repeat values dict 2: 
//dict[0 => 3]
```