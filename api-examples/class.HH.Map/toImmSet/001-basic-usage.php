<?hh

namespace Hack\UserDocumentation\API\Examples\Map\ToImmSet;

<<__EntryPoint>>
function basic_usage_main(): void {
  // This Map contains repetitions of the hex codes for 'red' and 'blue'
  $m = Map {
    'red' => '#ff0000',
    'also red' => '#ff0000',
    'green' => '#00ff00',
    'another red' => '#ff0000',
    'blue' => '#0000ff',
    'another blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  $imm_set = $m->toImmSet();

  \var_dump($imm_set is \HH\ImmSet<_>);
  \var_dump($imm_set);
}
