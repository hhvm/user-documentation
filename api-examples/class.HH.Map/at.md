This example prints the values at the keys `red` and `green` in the `Map`:

```existing-key.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Print the value at the key 'red'
\var_dump($m->at('red'));

// Print the value at the key 'yellow'
\var_dump($m->at('yellow'));
```

This example throws an `OutOfBoundsException` because the `Map` has no key 'blurple':

```missing-key.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Key 'blurple' doesn't exist (this will throw an exception)
\var_dump($m->at('blurple'));
```
