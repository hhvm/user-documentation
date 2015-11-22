<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Map\Ints;

$v  = Vector {'red', 'green', 'blue', 'yellow'};

$lengths = $v->map(fun('strlen'));
var_dump($lengths);
