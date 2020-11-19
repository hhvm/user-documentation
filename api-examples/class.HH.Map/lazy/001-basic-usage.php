<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Lazy;

<<__EntryPoint>>
function basic_usage_main(): void {
  $map = new Map(\range(0, 1000000));

  $s = \microtime(true);
  $non_lazy = $map->filter($x ==> $x % 2 === 0)->take(5);
  $e = \microtime(true);

  \var_dump($non_lazy);
  echo "Time non-lazy: ".\strval($e - $s).PHP_EOL;

  // Using a lazy view of the Map can save us a bunch of time, possibly even
  // cutting this call time by 90%.
  $s = \microtime(true);
  $lazy = $map->lazy()->filter($x ==> $x % 2 === 0)->take(5);
  $e = \microtime(true);

  \var_dump($lazy->toMap());
  echo "Time lazy: ".\strval($e - $s).PHP_EOL;
}
