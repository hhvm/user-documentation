This example shows how to get an iterator from a `Vector` and how to consume it:

```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Get an iterator for the Vector of colors
$iterator = $v->getIterator();

// Print each color using the iterator
while ($iterator->valid()) {
  echo $iterator->current()."\n";
  $iterator->next();
}
```
