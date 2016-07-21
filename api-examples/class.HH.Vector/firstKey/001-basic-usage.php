<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\FirstKey;

$v = Vector {'red', 'green', 'blue', 'yellow'};
var_dump($v->firstKey());

$v = Vector {};
var_dump($v->firstKey());
