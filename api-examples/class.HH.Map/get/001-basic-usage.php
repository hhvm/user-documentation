<?hh

namespace Hack\UserDocumentation\API\Examples\Map\Get;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Prints the value at key 'red'
  \var_dump($m->get('red'));

  // Prints NULL since key 'blurple' doesn't exist
  \var_dump($m->get('blurple'));
}
