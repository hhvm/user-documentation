<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\Keys;

$p = Pair {'foo', -1.5};
var_dump($p->keys());
