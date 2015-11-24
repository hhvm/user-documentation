<?hh

namespace Hack\UserDocumentation\API\Examples\Map\LastKey;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};
var_dump($m->lastKey());

$m = Map {};
var_dump($m->lastKey());
