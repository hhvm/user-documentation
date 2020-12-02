This example shows that converting a `Pair` to a `Set` also removes duplicate values:

```basic-usage.php
// This Pair contains 'foo' twice
$p = Pair {'foo', 'foo'};

$s = $p->toSet();
\var_dump($s);
```

This example shows that converting a `Pair` to a `Set` will throw a fatal error if the `Pair` contains a value that's not a `string` or an `int`:

```runtime-fatal.php
$p = Pair {'foo', -1.5};

/* HH_FIXME[4323] Fatal error will be thrown here */
$s = $p->toSet();

\var_dump($s);
```
