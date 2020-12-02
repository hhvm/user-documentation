This example shows how `toVector()` returns a `Vector` of `$m`'s values, so mutating this new `Vector` doesn't affect the original `Map`.

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Make a deep Vector copy of the values of $m
$v = $m->toVector();

// Modify $v by adding an element
$v->add('#663399');
\var_dump($v);

// The original Map $m doesn't include the value '#663399'
\var_dump($m);
```
