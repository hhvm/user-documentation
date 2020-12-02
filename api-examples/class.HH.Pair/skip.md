```basic-usage.php
$p = Pair {'foo', -1.5};

// Skipping 0 returns an ImmVector of both values
\var_dump($p->skip(0));

// Skipping 1 returns an ImmVector of the second value
\var_dump($p->skip(1));

// Skipping more than 1 returns an empty ImmVector
\var_dump($p->skip(2));
```
