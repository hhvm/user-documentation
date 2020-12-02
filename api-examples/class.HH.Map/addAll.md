The following example adds a collection of key-value pairs to the `Map` `$m` and also adds multiple collections of key-value pairs to `$m` through chaining. Since `Map::addAll()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$m` itself, you can chain a bunch of `addAll()` calls together.

```basic-usage.php
$m = Map {};

// Add all the key-value pairs in an array
$m->addAll(varray[Pair {'red', '#ff0000'}]);

// Map::addAll returns the Map so it can be chained
$m->addAll(Vector {
  Pair {'green', '#00ff00'},
  Pair {'blue', '#0000ff'},
})
  ->addAll(ImmVector {
    Pair {'yellow', '#ffff00'},
    Pair {'purple', '#663399'},
  });

\var_dump($m);
```
