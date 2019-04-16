<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToArray;

$p = Pair {'foo', -1.5};

$array = $p->toArray();

var_dump(is_array($array));
var_dump($array);
