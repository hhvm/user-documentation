<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Concat;

$p = Pair {'foo', -1.5};

$v = $p->concat(varray[100, 'bar']);
var_dump($v);
