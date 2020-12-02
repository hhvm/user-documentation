This example prints the first and last values of the `Vector`:

```existing-key.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Print the first element
\var_dump($v->at(0));

// Print the last element
\var_dump($v->at(3));
```

This example throws an `OutOfBoundsException` because the `Vector` has no index 10:

```missing-key.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Index 10 doesn't exist (this will throw an exception)
\var_dump($v->at(10));
```
