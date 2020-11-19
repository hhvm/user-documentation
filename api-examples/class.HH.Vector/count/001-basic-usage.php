<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Count;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {};
  \var_dump($v->count());

  $v = Vector {'red', 'green', 'blue', 'yellow'};
  \var_dump($v->count());
}
