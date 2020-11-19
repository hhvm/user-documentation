<?hh

namespace Hack\UserDocumentation\API\Examples\ImmMap\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $im = ImmMap {'a' => 1, 'b' => 2, 'c' => 3};
  echo $im->__toString()."\n";

  $im3 = ImmMap {};
  echo $im3->__toString()."\n";
}
