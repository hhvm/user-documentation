<?hh

namespace Hack\UserDocumentation\API\Examples\Map\Map\Ints;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$decimal_codes = $m->map(fun('hexdec'));
var_dump($decimal_codes);
