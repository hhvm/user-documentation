<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {'a' => 1, 'b' => 2, 'c' => 3};
  echo $m."\n";

  $m3 = Map {};
  echo $m3."\n";
}
