<?hh

namespace Hack\UserDocumentation\API\Examples\Set\ToImmMap;

$s = Set {'red', 'green', 'blue', 'yellow'};

$imm_map = $s->toImmMap();

var_dump($imm_map instanceof \HH\ImmMap);
var_dump($imm_map);

