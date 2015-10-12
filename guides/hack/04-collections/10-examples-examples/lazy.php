<?hh

namespace Hack\UserDocumentation\Collections\Examples\Examples\LazyM;

$vector = Vector {};
for ($i = 0; $i < 1000000; $i++) {
  $vector[] = $i;
}
$s = microtime(true);
$non_lazy = $vector->filter($x ==> $x % 2 === 0)->take(5);
$e = microtime(true);
var_dump($non_lazy);
echo "Time non lazy: " . strval($e-$s) . PHP_EOL;
unset($vector);
$vector = Vector {};
for ($i = 0; $i < 1000000; $i++) {
  $vector[] = $i;
}
$s = microtime(true);
// Using a lazy view of the vector can save us a bunch of time, possibly even
// cutting this call time by 90%.
$lazy = $vector->lazy()->filter($x ==> $x % 2 === 0)->take(5);
$e = microtime(true);
var_dump($lazy->toVector());
echo "Time non lazy: " . strval($e-$s) . PHP_EOL;
