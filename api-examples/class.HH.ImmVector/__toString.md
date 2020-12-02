The string version of a `Vector` is always `"Vector"`:

```basic-usage.php
$v = Vector {1, 2, 3};
echo $v->__toString()."\n";

$v2 = Vector {'a', 'b', 'c'};
echo $v2->__toString()."\n";

$v3 = Vector {};
echo $v3->__toString()."\n";
```
