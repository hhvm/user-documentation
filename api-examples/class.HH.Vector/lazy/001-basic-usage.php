<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Lazy;

<<__EntryPoint>>
function basic_usage_main(): void {
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
}
