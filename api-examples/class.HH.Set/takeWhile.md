This example shows how `takeWhile` can be used to create a new `Set` by taking elements from the beginning of an existing `Set`:

```basic-usage.php
$s = Set {0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144};

// Include values until we reach one over 10
$s2 = $s->takeWhile($x ==> $x <= 10);
\var_dump($s2);
```
