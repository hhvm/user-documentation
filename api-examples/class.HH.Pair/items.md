```basic-usage.php
$p = Pair {'foo', -1.5};

// Get an Iterable view of the Pair
$iterable = $p->items();

// Print both values in the Iterable
foreach ($iterable as $value) {
  echo (string)$value."\n";
}
```
