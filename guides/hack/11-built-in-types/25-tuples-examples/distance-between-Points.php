<?hh // strict

namespace Hack\UserDocumentation\Types\Tuples\Examples\Distance;

newtype Point = (float, float);

function create_point(float $x, float $y): Point {
  return tuple($x, $y);
}

function distance(Point $p1, Point $p2): float {
  $dx = $p1[0] - $p2[0];
  $dy = $p1[1] - $p2[1];
  return \sqrt($dx * $dx + $dy * $dy);
}
