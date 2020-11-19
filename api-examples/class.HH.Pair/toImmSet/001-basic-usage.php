<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToImmSet;

<<__EntryPoint>>
function basic_usage_main(): void {
  // This Pair contains 'foo' twice
  $p = Pair {'foo', 'foo'};

  $imm_set = $p->toImmSet();
  \var_dump($imm_set);
}
