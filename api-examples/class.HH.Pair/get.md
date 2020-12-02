```basic-usage.php
$p = Pair {'foo', -1.5};

// Print the first value
\var_dump($p->get(0));

// Print the second value
\var_dump($p->get(1));

// Print NULL since index 2 doesn't exist in a Pair
\var_dump($p->get(2));
```
