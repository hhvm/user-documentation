<?hh

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\Idx;

$point = shape('x' => 3, 'y' => null);

// The key 'z' doesn't exist in $point so our explicit default 0 is returned
var_dump(Shapes::idx($point, 'z', 0));

// The key 'y' exists so its value (NULL) is returned, not our explicit default 0
var_dump(Shapes::idx($point, 'y', 0));
