The following example adds a collection of values to the `Set` `$s` and also adds multiple collections of values to `$s` through chaining. Since `Set::addAll()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$s` itself, you can chain a bunch of `addAll()` calls together, and that will add all those collection of values to `$s`.

```basic-usage.php
$s = Set {};

// Add all the values in a Vector
$s->addAll(Vector {'a', 'b'});

// Add all the values in a Set
$s->addAll(Set {'c', 'd'});

// Add all the values in a Map
$s->addAll(Map {'foo' => 'e', 'bar' => 'f'});

// Add all the values in an array
$s->addAll(varray['g', 'h']);

// Set::addAll returns the Set so it can be chained
$s->addAll(ImmSet {'i', 'j'})
  ->addAll(ImmVector {'k', 'l'});

\var_dump($s);
```
