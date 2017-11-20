<?hh // strict

namespace Hack\UserDocumentation\Shapes\Subtyping\Examples\AllowUndefined;

type Point = shape(
  'x' => int,
  'y' => int,
  ... // allow undefined fields
);

function get_3d_point(): Point {
  // No error
  return shape('x' => 123, 'y' => 456, 'z' => 789);
}
