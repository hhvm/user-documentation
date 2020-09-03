<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Pair\ToValuesArray;

$p = Pair {'foo', -1.5};

$array = $p->toValuesArray();

var_dump(\HH\is_any_array($array));
var_dump($array);
