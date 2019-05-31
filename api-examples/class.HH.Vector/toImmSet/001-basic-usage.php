<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\ToImmSet;

// This Vector contains repetitions of 'red' and 'blue'
$v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

$imm_set = $v->toImmSet();

var_dump($imm_set instanceof \HH\ImmSet);
var_dump($imm_set);
