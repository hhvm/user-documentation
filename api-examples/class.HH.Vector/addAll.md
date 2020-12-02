The following example adds a collection of values to the `Vector` `$v` and also adds multiple collections of values to `$v` through chaining. Since `Vector::addAll()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$v` itself, you can chain a bunch of `addAll()` calls together, and that will add all those collection of values to `$v`.

```basic-usage.php
$v = Vector {};

// Add all the values in a Set
$v->addAll(Set {'a', 'b'});

// Add all the values in a Vector
$v->addAll(Vector {'c', 'd'});

// Add all the values in a Map
$v->addAll(Map {'foo' => 'e', 'bar' => 'f'});

// Add all the values in an array
$v->addAll(varray['g', 'h']);

// Vector::addAll returns the Vector so it can be chained
$v->addAll(ImmSet {'i', 'j'})
  ->addAll(ImmVector {'k', 'l'});

\var_dump($v);
```
