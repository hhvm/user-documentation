The string version of a `Set` is always `"Set"`:

```basic-usage.php
$s = Set {1, 2, 3};
echo $s->__toString()."\n";

$s2 = Set {'a', 'b', 'c'};
echo $s2->__toString()."\n";

$s3 = Set {};
echo $s3->__toString()."\n";
```
