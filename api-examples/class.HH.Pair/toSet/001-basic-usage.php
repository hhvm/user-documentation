<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Set;

// This Pair contains 'foo' twice
$p = Pair {'foo', 'foo'};

$s = $p->toSet();
var_dump($s);
