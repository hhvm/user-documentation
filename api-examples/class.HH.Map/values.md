This example shows how `values()` is identical to `toVector()`. It returns a new `Vector` of `$m`'s values, so mutating this new `Vector` doesn't affect the original `Map`.

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Get a Vector of $m's values
$v = $m->values();

// Modify $v by adding an element
$v->add('#663399');
\var_dump($v);

// The original Map $m doesn't include the value '#663399'
\var_dump($m);
```
