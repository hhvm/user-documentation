This example shows that converting a `Vector` to an `ImmSet` also removes duplicate values:

```basic-usage.php
// This Vector contains repetitions of 'red' and 'blue'
$v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

$imm_set = $v->toImmSet();

\var_dump($imm_set is \HH\ImmSet<_>);
\var_dump($imm_set);
```
