<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Take;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Take the first two elements
$take2 = $v->take(2);

var_dump($take2);
