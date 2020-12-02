The following example shows how to use `$offset` and `$len` together:

```basic-usage.php
// Remove the element at index 2:
$v = Vector {'red', 'green', 'blue', 'yellow'};
$v->splice(2, 1);
\var_dump($v); // $v contains 'red', 'green', 'yellow'

// Remove elements starting at index 2:
$v = Vector {'red', 'green', 'blue', 'yellow'};
$v->splice(2);
\var_dump($v); // $v contains 'red', 'green'

// Remove three elements starting at index 0:
$v = Vector {'red', 'green', 'blue', 'yellow'};
$v->splice(0, 3);
\var_dump($v); // $v contains 'yellow'

// Remove elements starting two positions from the end:
$v = Vector {'red', 'green', 'blue', 'yellow'};
$v->splice(-2);
\var_dump($v); // $v contains 'red', 'green

// Remove elements starting at index 0 and stopping one position from the end:
$v = Vector {'red', 'green', 'blue', 'yellow'};
$v->splice(0, -1);
\var_dump($v); // $v contains 'yellow'
```
