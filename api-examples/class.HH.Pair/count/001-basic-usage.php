<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Count;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};
  \var_dump($p->count());

  $p = Pair {null, null};
  \var_dump($p->count());
}
