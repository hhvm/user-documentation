<?hh

namespace Hack\UserDocumentation\API\Examples\Map\Remove;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

// Remove key 'red'
$m->remove('red');
var_dump($m);

// Remove keys 'green' and 'blue'
$m->remove('green')->remove('blue');
var_dump($m);
