<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\ToImmSet;

// This Pair contains 'foo' twice
$p = Pair {'foo', 'foo'};

$imm_set = $p->toImmSet();
var_dump($imm_set);
