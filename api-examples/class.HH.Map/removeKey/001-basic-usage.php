<?hh

namespace Hack\UserDocumentation\API\Examples\Map\RemoveKey;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Remove key 'red'
  $m->removeKey('red');
  \var_dump($m);

  // Remove keys 'green' and 'blue'
  $m->removeKey('green')->removeKey('blue');
  \var_dump($m);
}
