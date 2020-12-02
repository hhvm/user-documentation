The string version of a `Map` is always `"Map"`:

```basic-usage.php
$m = Map {'a' => 1, 'b' => 2, 'c' => 3};
echo $m->__toString()."\n";

$m3 = Map {};
echo $m3->__toString()."\n";
```
