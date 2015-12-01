<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToArray;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$array = $v->toArray();

var_dump(is_array($array));
var_dump($array);
