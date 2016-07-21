<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\IsEmpty;

$p = Pair {'foo', -1.5};
var_dump($p->isEmpty());

$p = Pair {null, -1.5};
var_dump($p->isEmpty());
