This example shows that `toKeysArray` is the same as `toValuesArray` because `Set`s don't have keys:

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};

$keys_array = $s->toKeysArray();

\var_dump($keys_array === $s->toValuesArray());
\var_dump($keys_array);
```
