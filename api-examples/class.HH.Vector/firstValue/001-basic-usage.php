<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\FirstValue;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};
  \var_dump($v->firstValue());

  $v = Vector {};
  \var_dump($v->firstValue());
}
