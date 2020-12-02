In this example the `Set`'s elements are mapped to the same type (`string`s):

```map-to-strings.php
$s = Set {'red', 'green', 'blue', 'yellow'};

$capitalized = $s->map(fun('strtoupper'));
\var_dump($capitalized);

$shortened = $s->map($color ==> \substr($color, 0, 3));
\var_dump($shortened);
```

In this example the `Set`'s elements are mapped to a different type (`int`s):

```map-to-ints.php
$s = Set {'red', 'green', 'blue', 'yellow'};

$lengths = $s->map(fun('strlen'));
\var_dump($lengths);
```
