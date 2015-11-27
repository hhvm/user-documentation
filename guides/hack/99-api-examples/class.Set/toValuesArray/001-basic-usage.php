<?hh

namespace Hack\UserDocumentation\API\Examples\Set\ToValuesArray;

$s = Set {'red', 'green', 'blue', 'yellow'};

$array = $s->toValuesArray();

var_dump(is_array($array));
var_dump($array);
