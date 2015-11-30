<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Concat;

$p = Pair {'foo', -1.5};

$v = $p->concat(array(100, 'bar'));
var_dump($v);
