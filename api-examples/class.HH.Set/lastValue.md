This example shows how `lastValue()` can be used even when a `Set` may be empty:

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};
\var_dump($s->lastValue());

$s = Set {};
\var_dump($s->lastValue());
```
