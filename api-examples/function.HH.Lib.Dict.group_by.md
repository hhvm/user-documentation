Group numbers by their parity (separate even and odd numbers):

```basic-usage.hack
$numbers = vec[1, 1, 2, 3, 5, 8, 14];
$groups = Dict\group_by($numbers, $value ==> $value % 2);
\print_r($groups);
```
