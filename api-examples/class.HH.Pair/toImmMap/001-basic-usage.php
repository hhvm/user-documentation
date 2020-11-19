<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToImmMap;

<<__EntryPoint>>
function basic_usage_main(): void {
  $p = Pair {'foo', -1.5};

  $imm_map = $p->toImmMap();

  \var_dump($imm_map is \HH\ImmMap<_, _>);
  \var_dump($imm_map);
}
