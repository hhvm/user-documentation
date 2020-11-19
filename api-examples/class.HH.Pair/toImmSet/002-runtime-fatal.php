<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToImmSet;

<<__EntryPoint>>
function runtime_fatal_main(): void {
  $p = Pair {'foo', -1.5};

  // Fatal error will be thrown here
  $imm_set = $p->toImmSet();

  \var_dump($imm_set);
}
