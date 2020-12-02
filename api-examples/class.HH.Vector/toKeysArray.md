```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

$keys_array = $v->toKeysArray();

\var_dump(\HH\is_any_array($keys_array));
\var_dump($keys_array);
```
