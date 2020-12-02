This example shows you how to use `lazy()` on a rather large `Set` and the time for both a *strict* and *non-strict* version. Since we only need 5 of the elements in the end, the lazy view actually allows us to stop after we meet our required 5 without having to actually filter and allocate all 1000000 elements up front.

```basic-usage.php
$set = new Set(\range(0, 1000000));

$s = \microtime(true);
$non_lazy = $set->filter($x ==> $x % 2 === 0)->take(5);
$e = \microtime(true);

\var_dump($non_lazy);
echo "Time non-lazy: ".\strval($e - $s).\PHP_EOL;

// Using a lazy view of the Set can save us a bunch of time, possibly even
// cutting this call time by 90%.
$s = \microtime(true);
$lazy = $set->lazy()->filter($x ==> $x % 2 === 0)->take(5);
$e = \microtime(true);

\var_dump(new Set($lazy));
echo "Time lazy: ".\strval($e - $s).\PHP_EOL;
```.hhvm.expectf
object(HH\Set) (5) {
  int(0)
  int(2)
  int(4)
  int(6)
  int(8)
}
Time non-lazy: %f
object(HH\Set) (5) {
  int(0)
  int(2)
  int(4)
  int(6)
  int(8)
}
Time lazy: %f
```.example.hhvm.out
object(HH\Set) (5) {
  int(0)
  int(2)
  int(4)
  int(6)
  int(8)
}
Time non-lazy: 0.11553406715393
object(HH\Set) (5) {
  int(0)
  int(2)
  int(4)
  int(6)
  int(8)
}
Time lazy: 0.0063431262969971
```
