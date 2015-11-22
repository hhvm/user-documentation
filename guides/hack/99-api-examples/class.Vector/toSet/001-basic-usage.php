<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToSet;

// This Vector contains repetitions of 'red' and 'blue'
$v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

$set = $v->toSet();

var_dump($set instanceof \HH\Set);
var_dump($set);
