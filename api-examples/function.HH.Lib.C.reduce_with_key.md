```basic-usage.hack
$dict = dict["a" => 1, "b" => 2, "c" => 3];
$list = vec["a","b"];
$reduce_with_key_result = C\reduce_with_key($dict, ($a, $k, $v) ==> $a + (C\contains($list, $k) ? 0 : $v), 0);
echo "Reduce with key result: $reduce_with_key_result\n";
//Output: Reduce with key result: 3
```