<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Reverse;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$v->reverse();

var_dump($v);
