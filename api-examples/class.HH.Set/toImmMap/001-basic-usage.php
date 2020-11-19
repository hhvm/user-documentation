<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Set\ToImmMap;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {'red', 'green', 'blue', 'yellow'};

  $imm_map = $s->toImmMap();

  \var_dump($imm_map is \HH\ImmMap<_, _>);
  \var_dump($imm_map);
}
