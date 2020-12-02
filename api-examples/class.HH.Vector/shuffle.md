```basic-usage.php
$v = Vector {'red', 'green', 'blue', 'yellow'};

// Randomize the Vector elements in place
$v->shuffle();

\var_dump($v);
```.hhvm.expectf
object(HH\Vector) (4) {
  [0]=>
  string(%d) "%s"
  [1]=>
  string(%d) "%s"
  [2]=>
  string(%d) "%s"
  [3]=>
  string(%d) "%s"
}
```.example.hhvm.out
object(HH\Vector) (4) {
  [0]=>
  string(4) "blue"
  [1]=>
  string(5) "green"
  [2]=>
  string(6) "yellow"
  [3]=>
  string(3) "red"
}
```
