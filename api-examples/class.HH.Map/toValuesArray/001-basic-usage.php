<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\ToValuesArray;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$array = $m->toValuesArray();

var_dump(is_array($array));
var_dump($array);
