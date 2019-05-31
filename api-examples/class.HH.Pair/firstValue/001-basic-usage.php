<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\FirstValue;

$p = Pair {'foo', -1.5};
var_dump($p->firstValue());
