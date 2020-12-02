```basic-usage.php
$p = Pair {'foo', -1.5};

// Prints 0 (the index of the first value)
\var_dump($p->linearSearch('foo'));

// Prints 1 (the index of the second value)
\var_dump($p->linearSearch(-1.5));

// Prints -1 (the value doesn't exist in the Pair)
\var_dump($p->linearSearch('bar'));
```
