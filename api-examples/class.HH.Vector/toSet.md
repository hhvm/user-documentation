This example shows that converting a `Vector` to a `Set` also removes duplicate values:

```basic-usage.php
// This Vector contains repetitions of 'red' and 'blue'
$v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

$set = $v->toSet();

\var_dump($set is \HH\Set<_>);
\var_dump($set);
```
