<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\At\ExistingKey;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Print the value at the key 'red'
var_dump($m->at('red'));

// Print the value at the key 'yellow'
var_dump($m->at('yellow'));
