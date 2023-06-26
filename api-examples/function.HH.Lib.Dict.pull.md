```basic-usage.hack
$original_vec = vec[1, 2, 3, 4, 5];
$dict_after_pull = Dict\pull($original_vec, $value ==> $value % 2, $key ==> $key + 1);
echo "Dict after pull: \n";
\print_r($dict_after_pull);
//Output: Dict after pull:
//dict[2 => 1, 3 => 0, 4 => 1, 5 => 0, 6 => 1]
```