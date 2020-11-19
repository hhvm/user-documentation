<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {1, 2, 3};
  echo $v."\n";

  $v2 = Vector {'a', 'b', 'c'};
  echo $v2."\n";

  $v3 = Vector {};
  echo $v3."\n";
}
