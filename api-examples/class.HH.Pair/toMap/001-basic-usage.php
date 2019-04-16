<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToMap;

$p = Pair {'foo', -1.5};

$map = $p->toMap();

var_dump($map instanceof \HH\Map);
var_dump($map);
