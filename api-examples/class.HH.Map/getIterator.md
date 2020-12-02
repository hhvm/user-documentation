This example shows how to get a `KeyedIterator` from a `Map` and how to consume it:

```basic-usage.php
$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Get an iterator for the Map of colors to hex codes
$iterator = $m->getIterator();

// Print each color (key) and hex code (value) using the iterator
while ($iterator->valid()) {
  echo $iterator->key().' => '.$iterator->current()."\n";
  $iterator->next();
}
```
