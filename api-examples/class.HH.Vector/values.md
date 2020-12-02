This example shows how `values()` is identical to `toVector()`. It returns a deep copy of `$v`, so mutating this new `Vector` doesn't affect the original.

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Make a deep Vector copy of $v
$v2 = $v->values();

// Modify $v2 by adding an element
$v2->add('purple');
\var_dump($v2);

// The original Vector $v doesn't include 'purple'
\var_dump($v);
```
