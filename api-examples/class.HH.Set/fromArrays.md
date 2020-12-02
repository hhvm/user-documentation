This example shows that duplicate values in the input arrays only appear once in the final `Set`:

```basic-usage.php
$s = Set::fromArrays(
  varray['red'],
  varray['green', 'blue'],
  varray['yellow', 'red'], // Duplicate 'red' will be ignored
);

\var_dump($s);
```
