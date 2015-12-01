<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToMap;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$map = $v->toMap();

var_dump($map instanceof \HH\Map);
var_dump($map->keys());
var_dump($map);
