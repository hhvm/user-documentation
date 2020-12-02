This example shows that `items()` returns an `Iterable` view of the `Map`. The `Iterable` will produce the key-value pairs of the `Map` at the time it's iterated.

```basic-usage.php
<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Get an Iterable view of the Map
  $items = $m->items();

  // Add another color to the original Map $m
  $m->add(Pair {'purple', '#663399'});

  // Print each color and hex code using the Iterable
  foreach ($items as $key_value_pair) {
    echo $key_value_pair[0].' => '.$key_value_pair[1]."\n";
  }
}

// This wouldn't work because the Iterable interface is read-only:
// $iterable->add(Pair {'purple', '#ff6600'});
```
