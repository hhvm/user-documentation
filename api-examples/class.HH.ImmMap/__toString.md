The string version of an `ImmMap` is always `"ImmMap"`:

```basic-usage.php
$im = ImmMap {'a' => 1, 'b' => 2, 'c' => 3};
echo $im->__toString()."\n";

$im3 = ImmMap {};
echo $im3->__toString()."\n";
```
