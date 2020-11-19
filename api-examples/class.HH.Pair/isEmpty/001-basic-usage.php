<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\IsEmpty;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};
  \var_dump($p->isEmpty());

  $p = Pair {null, -1.5};
  \var_dump($p->isEmpty());
}
