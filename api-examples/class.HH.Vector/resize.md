This example shows how `resize` can be used to decrease and increase the size of a `Vector`:

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Resize the Vector to 2 (removing 'blue' and 'yellow')
$v->resize(2, null);
\var_dump($v);

// Resize the Vector back to 4 (filling in 'unknown' for new elements)
$v->resize(4, 'unknown');
\var_dump($v);
```
