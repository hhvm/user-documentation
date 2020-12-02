This example shows that `zip` won't thrown an `Exception` if at least one of the current `Set` or the `$traversable` is empty:

```empty-usage.php
// The $traversable is empty so the result will be empty
$s = Set {'red', 'green', 'blue', 'yellow'};
$zipped = $s->zip(Vector {});
\var_dump($zipped);

// The Set $s is empty so the result will be empty
$s = Set {};
$zipped = $s->zip(Vector {'My Favorite', 'My Second Favorite'});
\var_dump($zipped);
```

This example shows that `zip` will throw an `Exception` if the result is non-empty:

```nonempty-exception.php
$s = Set {'red', 'green', 'blue', 'yellow'};
$zipped = $s->zip(Vector {'My Favorite', 'My Second Favorite'});
\var_dump($zipped);
```
