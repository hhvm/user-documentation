<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToVector;

$p = Pair {'foo', -1.5};

$v = $p->toVector();
var_dump($v);
