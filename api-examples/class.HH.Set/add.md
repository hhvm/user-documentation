The following example adds a single value to the `Set` `$s` and also adds multiple values to `$s` through chaining. Since `Set::add()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$s` itself, you can chain a bunch of `add()` calls together, and that will add all those values to `$s`. Notice that adding a value that already exists in the `Set` has no effect.

```basic-usage.php
$s = Set {};

$s->add('red');
\var_dump($s);

// Set::add returns the Set so it can be chained
$s->add('green')
  ->add('blue')
  ->add('yellow');
\var_dump($s);

// Adding an element that already exists in the Set has no effect
$s->add('green')
  ->add('blue')
  ->add('yellow');
\var_dump($s);
```
