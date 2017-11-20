<?hh // strict

namespace Hack\UserDocumentation\Shapes\Introduction\Examples\Optional;

// 'z' field is optional
type Point = shape('x' => int, 'y' => int, ?'z' => int);

function get_2d_point(): Point {
  return shape('x' => 123, 'y' => 456);
}

function get_3d_point(): Point {
  return shape('x' => 123, 'y' => 456, 'z' => 789);
}
