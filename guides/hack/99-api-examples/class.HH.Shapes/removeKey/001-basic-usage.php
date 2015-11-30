<?hh

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\RemoveKey;

$point = shape('x' => 3, 'y' => -1);

// Prints the value at key 'y'
var_dump($point['y']);

Shapes::removeKey($point, 'y');

// Prints NULL because the key 'y' doesn't exist any more
var_dump(Shapes::idx($point, 'y'));
