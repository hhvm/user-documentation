```basic-usage.hack
$values = vec[1,2,3,4,5];
$reduce_result = C\reduce($values, ($total, $value) ==> $total + $value, 0);
echo "Reduce result: $reduce_result\n";
//Output: Reduce result: 15
```
