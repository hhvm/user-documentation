This example shows how to get an iterator from a `Pair` and how to consume it:

```basic-usage.php
$p = Pair {'foo', -1.5};

// Get a KeyedIterator for the Pair
$iterator = $p->getIterator();

// Print both keys and values
while ($iterator->valid()) {
  echo $iterator->key().' => '.(string)$iterator->current()."\n";
  $iterator->next();
}
```
