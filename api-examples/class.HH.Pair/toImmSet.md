This example shows that converting a `Pair` to an `ImmSet` also removes duplicate values:

```basic-usage.php
// This Pair contains 'foo' twice
$p = Pair {'foo', 'foo'};

$imm_set = $p->toImmSet();
\var_dump($imm_set);
```

This example shows that converting a `Pair` to an `ImmSet` will throw a fatal error if the `Pair` contains a value that's not a `string` or an `int`:

```runtime-fatal.php
$p = Pair {'foo', -1.5};

/* HH_FIXME[4323] Fatal error will be thrown here */
$imm_set = $p->toImmSet();

\var_dump($imm_set);
```
