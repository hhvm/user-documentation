This example shows that `toSet` returns a deep copy of the `Set`:

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};

// Make a deep copy of Set $s
$s2 = $s->toSet();

// Modify $s2 by adding an element
$s2->add('purple');
\var_dump($s2);

// The original Set $s doesn't include 'purple'
\var_dump($s);
```
