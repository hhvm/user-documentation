<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\Concat;

$v = Vector {'red'};

// Add all the values in a Set
$v1 = $v->concat(Set {'green', 'blue'});

// Add all the values in an array
$v2 = $v1->concat(varray['yellow', 'purple']);

var_dump($v); // $v contains 'red'
var_dump($v1); // $v1 contains 'red', 'green', 'blue'
var_dump($v2); // $v2 contains 'red', 'green', 'blue', 'yellow', 'purple'
