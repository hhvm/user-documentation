This example shows that `keys()` returns a `Vector` of the `Set`'s values because `Set`s don't have keys:

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};
\var_dump($s->keys());
```
