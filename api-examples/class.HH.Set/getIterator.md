This example shows how to get an iterator from a `Set` and how to consume it:

```basic-usage.php
$s = Set {'red', 'green', 'blue', 'yellow'};

// Get an iterator for the Set of colors
$iterator = $s->getIterator();

// Print each color using the iterator
while ($iterator->valid()) {
  echo $iterator->current()."\n";
  $iterator->next();
}
```
