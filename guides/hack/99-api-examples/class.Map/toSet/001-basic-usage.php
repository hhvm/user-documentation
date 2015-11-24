<?hh

namespace Hack\UserDocumentation\API\Examples\Map\ToSet;

// This Map contains repetitions of the hex codes for 'red' and 'blue'
$m = Map {
  'red' => '#ff0000',
  'also red' => '#ff0000',
  'green' => '#00ff00',
  'another red' => '#ff0000',
  'blue' => '#0000ff',
  'another blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$set = $m->toSet();

var_dump($set instanceof \HH\Set);
var_dump($set);
