In this example the `Pair`'s values are mapped to `0` if they're `NULL`:

```basic-usage.php
$p = Pair {null, -1.5};

$immutable_v = $p->map($value ==> {
  if ($value === null) {
    return 0;
  }
  return $value;
});
\var_dump($immutable_v);
```
