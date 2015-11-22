<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\Values;

$v = Vector {'red', 'green', 'blue', 'yellow'};

// Make a deep Vector copy of $v
$v2 = $v->values();

// Modify $v2 by adding an element
$v2->add('purple');
var_dump($v2);

// The original Vector $v doesn't include 'purple'
var_dump($v);
