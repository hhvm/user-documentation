<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\ToImmMap;

$p = Pair {'foo', -1.5};

$imm_map = $p->toImmMap();

var_dump($imm_map instanceof \HH\ImmMap);
var_dump($imm_map);

