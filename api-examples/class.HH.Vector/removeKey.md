Since `Vector::removeKey()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$v` itself, you can chain a bunch of `removeKey()` calls together.

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Remove 'blue' at index 2
$v->removeKey(2);
\var_dump($v);

// Remove 'red' and then remove 'green'
$v->removeKey(0)->removeKey(0);
\var_dump($v);
```
