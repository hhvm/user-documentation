<?hh

namespace Hack\UserDocumentation\API\Examples\Set\Concat;

$s = Set {'red'};

// Add all the values in a Vector
$s1 = $s->concat(Vector {'green', 'blue'});

// Add all the values in an array
$s2 = $s1->concat(array('yellow', 'purple'));

var_dump($s); // $s contains 'red'
var_dump($s1); // $s1 contains 'red', 'green', 'blue'
var_dump($s2); // $s2 contains 'red', 'green', 'blue', 'yellow', 'purple'
