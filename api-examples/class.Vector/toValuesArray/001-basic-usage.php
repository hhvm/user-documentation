<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToValuesArray;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$array = $v->toValuesArray();

var_dump(is_array($array));
var_dump($array);
