Since `Map::remove()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$m` itself, you can chain a bunch of `remove()` calls together.

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Remove key 'red'
$m->remove('red');
\var_dump($m);

// Remove keys 'green' and 'blue'
$m->remove('green')->remove('blue');
\var_dump($m);
```
