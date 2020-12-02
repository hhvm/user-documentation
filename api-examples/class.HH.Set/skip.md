```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};

// Create a new Set after skipping the first two elements ('red' and 'green')
$skip2 = $s->skip(2);

\var_dump($skip2);
```
