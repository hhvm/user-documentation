<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\ToVector;

$inner = Vector {1, 2, 3};
$v = Vector {'a', $inner, 'c'};

// Make a Vector copy of $v
$v2 = $v->toVector();

// Modify the original Vector $v's inner Vector by adding an element
$v[1]->add(4);

// The original Vector $v's inner Vector includes 4.
var_dump($v);

// The new Vector $v2's inner Vector also includes 4. toVector() only does a shallow copy.
var_dump($v2);
