<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\Filter;

$p = Pair {null, -1.5};

$v = $p->filter($value ==> $value !== null);
var_dump($v);
