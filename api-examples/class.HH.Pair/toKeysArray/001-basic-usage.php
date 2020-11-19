<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\ToKeysArray;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  \var_dump($p->toKeysArray());
}
