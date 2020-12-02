This example shows how `get` can be used to access the value at a key that may not exist:

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Prints the value at key 'red'
\var_dump($m->get('red'));

// Prints NULL since key 'blurple' doesn't exist
\var_dump($m->get('blurple'));
```
