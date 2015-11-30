<?hh

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\ToArray;

$point = shape('name' => 'Jane Doe', 'age' => 55, 'points' => 25.30);

var_dump(Shapes::toArray($point));
