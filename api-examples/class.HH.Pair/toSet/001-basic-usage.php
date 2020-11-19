<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Set;

<<__EntryPoint>>
function basic_usage_main(): void {
  // This Pair contains 'foo' twice
  $p = Pair {'foo', 'foo'};

  $s = $p->toSet();
  \var_dump($s);
}
