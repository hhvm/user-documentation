<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Values;

$p = Pair {'foo', -1.5};

$immutable_v = $p->values();

var_dump($immutable_v);
