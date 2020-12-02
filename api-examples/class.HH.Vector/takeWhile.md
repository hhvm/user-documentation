This example shows how `takeWhile` can be used to create a new `Vector` by taking elements from the beginning of an existing `Vector`:

```basic-usage.php
$v = Vector {0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144};

// Include values until we reach one over 10
$v2 = $v->takeWhile($x ==> $x <= 10);
\var_dump($v2);
```
