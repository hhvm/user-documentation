<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Set;

$p = Pair {'foo', -1.5};

// Fatal error will be thrown here
$s = $p->toSet();

var_dump($s);
