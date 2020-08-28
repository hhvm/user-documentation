<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\ToValuesArray;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$array = $v->toValuesArray();

var_dump(\HH\is_any_array($array));
var_dump($array);
