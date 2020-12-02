```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow', 'purple'};

// Only include elements with an odd index
$odd_elements = $v->filterWithKey(($index, $color) ==> ($index % 2) !== 0);

\var_dump($odd_elements);
```
