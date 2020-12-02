This example shows that removing a value that doesn't exist in the `Set` has no effect:

```basic-usage.php
$s = Set {'red', 'green'};

// Remove 'red' from the Set
$s->remove('red');
\var_dump($s);

// Remove 'red' again (has no effect)
$s->remove('red');
\var_dump($s);
```
