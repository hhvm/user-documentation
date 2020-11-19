<?hh

namespace Hack\UserDocumentation\API\Examples\HH\Shapes\Idx;

function runNullable(shape('x' => ?int, 'y' => ?int, ...) $point): void {
  // The key 'x' exists, so its value (3) is returned, not our explicit default 0
  \var_dump(Shapes::idx($point, 'x', 0));

  // The key 'y' exists, so its value (NULL) is returned, not our explicit default 0
  \var_dump(Shapes::idx($point, 'y', 0));
}

<<__EntryPoint>>
function runNullableMain(): void {
  runNullable(shape('x' => 3, 'y' => null));
}
