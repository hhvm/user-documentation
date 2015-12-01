<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Pop\BasicUsage;

$v = Vector {'red', 'green', 'blue', 'yellow'};

$last_color = $v->pop();

var_dump($last_color);
var_dump($v);
