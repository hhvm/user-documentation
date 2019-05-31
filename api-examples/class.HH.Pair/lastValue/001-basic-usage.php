<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\LastValue;

$p = Pair {'foo', -1.5};
var_dump($p->lastValue());
