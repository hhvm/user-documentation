```basic-usage.hack
$strings= vec["a", "a", "a", "b", "b", "c", "d", "d", "d", "d", "d"];
$dict = Dict\count_values($strings);
echo "Dict after count values: \n";
\print_r($dict);
//Output: Dict after count values:
//dict["a" => 3, "b" => 2, "c" => 1, "d" => 5]
```