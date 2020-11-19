<?hh // partial

namespace Hack\UserDocumentation\API\Examples\ImmSet\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $is = ImmSet {1, 2, 3};
  echo $is->__toString()."\n";

  $is2 = ImmSet {'a', 'b', 'c'};
  echo $is2->__toString()."\n";

  $is3 = ImmSet {};
  echo $is3->__toString()."\n";
}
