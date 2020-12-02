The following example adds a single key-value pair to the `Map` `$m` and also adds multiple key-value pairs to `$m` through chaining. Since `Map::add()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$m` itself, you can chain a bunch of `add()` calls together, and that will add all those values to `$m`.

```basic-usage.php
$m = Map {};

$m->add(Pair {'red', '#ff0000'});
\var_dump($m);

// Map::add returns the Map so it can be chained
$m->add(Pair {'green', '#00ff00'})
  ->add(Pair {'blue', '#0000ff'})
  ->add(Pair {'yellow', '#ffff00'});
\var_dump($m);
```
