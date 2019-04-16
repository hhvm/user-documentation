<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\Keys;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};
var_dump($m->keys());
