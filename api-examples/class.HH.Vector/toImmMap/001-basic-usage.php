<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\ToImmMap;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$imm_map = $v->toImmMap();

var_dump($imm_map instanceof \HH\ImmMap);
var_dump($imm_map->keys());
var_dump($imm_map);

