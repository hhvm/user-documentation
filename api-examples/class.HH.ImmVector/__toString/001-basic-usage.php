<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\__toString;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {1, 2, 3};
  echo $v->__toString()."\n";

  $v2 = Vector {'a', 'b', 'c'};
  echo $v2->__toString()."\n";

  $v3 = Vector {};
  echo $v3->__toString()."\n";
}
