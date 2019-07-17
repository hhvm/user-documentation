<?hh // partial

namespace Hack\UserDocumentation\API\Examples\Vector\ToSet;

// This Vector contains repetitions of 'red' and 'blue'
$v = Vector {'red', 'green', 'red', 'blue', 'red', 'yellow', 'blue'};

$set = $v->toSet();

var_dump($set is \HH\Set<_>);
var_dump($set);
