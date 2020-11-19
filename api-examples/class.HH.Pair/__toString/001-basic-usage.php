<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {-1, 5};
  echo $p->__toString()."\n";

  $p2 = Pair {'foo', 'bar'};
  echo $p2->__toString()."\n";
}
