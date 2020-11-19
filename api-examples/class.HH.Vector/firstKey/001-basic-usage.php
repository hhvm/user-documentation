<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\FirstKey;

<<__EntryPoint>>
function basic_usage_main(): void {
  $v = Vector {'red', 'green', 'blue', 'yellow'};
  \var_dump($v->firstKey());

  $v = Vector {};
  \var_dump($v->firstKey());
}
