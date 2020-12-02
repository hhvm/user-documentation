This example shows how `get` can be used to access an index that may not exist:

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Index 0 is the element 'red'
\var_dump($v->get(0));

// Index 10 doesn't exist
\var_dump($v->get(10));
```
