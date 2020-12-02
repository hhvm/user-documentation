This example removes multiple values from a `Set` and shows that the list of values to be removed can contain duplicates:

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};

$s->removeAll(Vector {
  'red',
  'blue',
  'red',
});

\var_dump($s);
```
