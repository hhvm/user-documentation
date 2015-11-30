<?hh

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\Idx;

$point = shape('x' => 3, 'y' => -1);

// The key 'x' exists in the Shape $point so it's returned
var_dump(Shapes::idx($point, 'x'));

// The key 'z' doesn't exist in $point so the default NULL is returned
var_dump(Shapes::idx($point, 'z'));

// The key 'z' doesn't exist in $point so our explicit default 0 is returned
var_dump(Shapes::idx($point, 'z', 0));
