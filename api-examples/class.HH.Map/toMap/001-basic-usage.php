<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Map\ToMap;

$m = Map {
  'red' => '#ff0000',
  'green' => '#00ff00',
  'blue' => '#0000ff',
  'yellow' => '#ffff00',
};

$m2 = $m->toMap();
$m2->add(Pair {'purple', '#663399'});

var_dump($m);
var_dump($m2);
