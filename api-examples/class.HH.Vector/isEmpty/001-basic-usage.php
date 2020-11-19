<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\IsEmpty;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {};
  \var_dump($v->isEmpty());

  $v = Vector {'red', 'green', 'blue', 'yellow'};
  \var_dump($v->isEmpty());
}
