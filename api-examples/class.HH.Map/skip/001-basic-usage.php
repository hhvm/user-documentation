<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Skip;

<<__EntryPoint>>
function basic_usage_main(): void {
  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Create a new Map after skipping the first two elements ('red' and 'green')
  $skip2 = $m->skip(2);

  \var_dump($skip2);
}
