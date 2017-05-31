<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToVector;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Make a new Vector that is a copy of $v (i.e. contains the same elements)
$v2 = $v->toVector();

// Modify $v2 by adding an element
$v2->add('purple');
var_dump($v2);

// The original Vector $v doesn't include 'purple'
var_dump($v);
