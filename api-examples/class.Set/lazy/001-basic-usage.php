<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Lazy;

$set = new Set(range(0, 1000000));

$s = microtime(true);
$non_lazy = $set->filter($x ==> $x % 2 === 0)->take(5);
$e = microtime(true);

var_dump($non_lazy);
echo "Time non-lazy: " . strval($e - $s) . PHP_EOL;

// Using a lazy view of the Set can save us a bunch of time, possibly even
// cutting this call time by 90%.
$s = microtime(true);
$lazy = $set->lazy()->filter($x ==> $x % 2 === 0)->take(5);
$e = microtime(true);

var_dump($lazy->toSet());
echo "Time lazy: " . strval($e - $s) . PHP_EOL;
