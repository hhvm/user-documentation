<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToKeysArray;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$keys_array = $v->toKeysArray();

var_dump(is_array($keys_array));
var_dump($keys_array);
