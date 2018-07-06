<?hh

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\KeyExists;

function run(shape(?'x' => ?int, ?'y' => ?int, ?'z' => ?int) $point): void {
  // The key 'x' exists in Shape $point
  \var_dump(Shapes::keyExists($point, 'x'));

  // The key 'z' doesn't exist in $point
  \var_dump(Shapes::keyExists($point, 'z'));

  // The key 'y' exists in $point, even though its value is NULL
  \var_dump(Shapes::keyExists($point, 'y'));
}

run(shape('x' => 3, 'y' => null));