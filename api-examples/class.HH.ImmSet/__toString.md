The string version of an `ImmSet` is always `"ImmSet"`:

```basic-usage.php
$is = ImmSet {1, 2, 3};
echo $is->__toString()."\n";

$is2 = ImmSet {'a', 'b', 'c'};
echo $is2->__toString()."\n";

$is3 = ImmSet {};
echo $is3->__toString()."\n";
```
