Since `Vector::set()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$v` itself, you can chain a bunch of `set()` calls together.

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Set the first element to 'RED'
$v->set(0, 'RED');

\var_dump($v);

// Set the second and third elements using chaining
$v->set(1, 'GREEN')
  ->set(2, 'BLUE');

\var_dump($v);
```
