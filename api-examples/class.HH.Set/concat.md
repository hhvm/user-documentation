This example creates new `Set`s by concatenating other `Traversable`s. Unlike `Set::addAll()` this method returns a new `Set` (not a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy)).

```basic-usage.php
$s = Set {'red'};

// Add all the values in a Vector
$s1 = $s->concat(Vector {'green', 'blue'});

// Add all the values in an array
$s2 = $s1->concat(varray['yellow', 'purple']);

\var_dump($s); // $s contains 'red'
\var_dump($s1); // $s1 contains 'red', 'green', 'blue'
\var_dump($s2); // $s2 contains 'red', 'green', 'blue', 'yellow', 'purple'
```
