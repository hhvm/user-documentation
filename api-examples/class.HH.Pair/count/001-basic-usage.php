<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Count;

$p = Pair {'foo', -1.5};
var_dump($p->count());

$p = Pair {null, null};
var_dump($p->count());
