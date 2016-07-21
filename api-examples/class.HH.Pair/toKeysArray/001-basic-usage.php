<?hh

namespace Hack\UserDocumentation\API\Examples\Pair\ToKeysArray;

$p = Pair {'foo', -1.5};

var_dump($p->toKeysArray());
