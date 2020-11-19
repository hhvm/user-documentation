<?hh

namespace Hack\UserDocumentation\API\Examples\Map\Set;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Set the value at key 'red'
  $m->set('red', 'rgb(255, 0, 0)');

  // Set the values at keys 'green' and 'blue'
  $m->set('green', 'rgb(0, 255, 0)')
    ->set('blue', 'rgb(0, 0, 255)');

  \var_dump($m);
}
