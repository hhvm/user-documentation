This example shows you how to use `lazy()` on a rather large `Vector` and the time for both a *strict* and *non-strict* version. Since we only need 5 of the elements in the end, the lazy view actually allows us to stop after we meet our required 5 without having to actually filter and allocate all 1000000 elements up front.

```basic-usage.php
$vector = new Vector(\range(0, 1000000));

$s = \microtime(true);
$non_lazy = $vector->filter($x ==> $x % 2 === 0)->take(5);
$e = \microtime(true);

\var_dump($non_lazy);
echo "Time non-lazy: ".\strval($e - $s).\PHP_EOL;

// Using a lazy view of the vector can save us a bunch of time, possibly even
// cutting this call time by 90%.
$s = \microtime(true);
$lazy = $vector->lazy()->filter($x ==> $x % 2 === 0)->take(5);
$e = \microtime(true);

\var_dump(new Vector($lazy));
echo "Time lazy: ".\strval($e - $s).\PHP_EOL;
```.hhvm.expectf
object(HH\Vector) (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time non-lazy: %f
object(HH\Vector) (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time lazy: %f
```.example.hhvm.out
object(HH\Vector) (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time non-lazy: 0.053816556930542
object(HH\Vector) (5) {
  [0]=>
  int(0)
  [1]=>
  int(2)
  [2]=>
  int(4)
  [3]=>
  int(6)
  [4]=>
  int(8)
}
Time lazy: 0.0069270133972168
```
