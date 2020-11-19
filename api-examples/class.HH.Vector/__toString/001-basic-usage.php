<?hh

namespace Hack\UserDocumentation\API\Examples\ImmVector\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $iv = ImmVector {1, 2, 3};
  echo $iv->__toString()."\n";

  $iv2 = ImmVector {'a', 'b', 'c'};
  echo $iv2->__toString()."\n";

  $iv3 = ImmVector {};
  echo $iv3->__toString()."\n";
}
