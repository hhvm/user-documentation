In this example the `Vector`'s elements are mapped to the same type (`string`s):

```map-to-strings.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

$capitalized = $v->map(fun('strtoupper'));
\var_dump($capitalized);

$shortened = $v->map($color ==> \substr($color, 0, 3));
\var_dump($shortened);
```

In this example the `Vector`'s elements are mapped to a different type (`int`s):

```map-to-ints.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

$lengths = $v->map(fun('strlen'));
\var_dump($lengths);
```
