This example prints the first and second values of the `Pair`:

```existing-key.php
$p = Pair {'foo', -1.5};

// Print the first element
\var_dump($p->at(0));

// Print the second element
\var_dump($p->at(1));
```

This example throws an `OutOfBoundsException` because a `Pair` only has the indexes `0` and `1`:

```missing-key.php
$p = Pair {'foo', -1.5};

// Index 2 doesn't exist because pairs always have exactly two elements
\var_dump($p->at(2));
```
