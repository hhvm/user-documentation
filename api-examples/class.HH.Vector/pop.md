This example shows that `pop()` returns the last element and removes it from the `Vector`:

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

$last_color = $v->pop();

\var_dump($last_color);
\var_dump($v);
```

This example shows that trying to `pop` from an empty `Vector` will throw an exception:

```throw-exception.php
$v = Vector {};

$last_element = $v->pop(); // Throws InvalidOperationException
```
