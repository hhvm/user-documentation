The string version of an `ImmVector` is always `"ImmVector"`:

```basic-usage.php
$iv = ImmVector {1, 2, 3};
echo $iv->__toString()."\n";

$iv2 = ImmVector {'a', 'b', 'c'};
echo $iv2->__toString()."\n";

$iv3 = ImmVector {};
echo $iv3->__toString()."\n";
```
