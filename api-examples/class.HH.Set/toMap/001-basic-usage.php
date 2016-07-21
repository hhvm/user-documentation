<?hh

namespace Hack\UserDocumentation\API\Examples\Set\ToMap;

$s = Set {'red', 'green', 'blue', 'yellow'};

$map = $s->toMap();

var_dump($map instanceof \HH\Map);
var_dump($map);
