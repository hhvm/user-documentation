The following example adds a single value to the `Vector` `$v` and also adds multiple values to `$v` through chaining. Since `Vector::add()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$v` itself, you can chain a bunch of `add()` calls together, and that will add all those values to `$v`.

```basic-usage.php
$v = Vector {};

$v->add('red');
\var_dump($v);

// Vector::add returns the Vector so it can be chained
$v->add('green')
  ->add('blue')
  ->add('yellow');
\var_dump($v);
```
