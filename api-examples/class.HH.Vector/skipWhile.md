This example shows how `skipWhile` can be used to create a new `Vector` by skipping elements at the beginning of an existing `Vector`:

```basic-usage.php
$v = Vector {0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144};

// Skip values until we reach one over 10
$v2 = $v->skipWhile($x ==> $x <= 10);
\var_dump($v2);
```
