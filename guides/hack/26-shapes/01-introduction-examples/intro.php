<?hh

namespace Hack\UserDocumentation\Shapes\Introduction\Examples\Intro;

type Point = shape('x' => int, 'y' => int);

class C1 {
  private Point $origin;
  private function __construct(int $x = 0, int $y = 0) {
    $this->origin = shape('x' => $x, 'y' => $y);
  }
}

function distance_between_2_Points(Point $p1, Point $p2): float {
  // access shape info via keys in the shape map, in this case `x` and `y`
  $dx = $p1['x'] - $p2['x'];
  $dy = $p1['y'] - $p2['y'];
  return \sqrt($dx*$dx + $dy*$dy);
}

function run(): void {
  $p1 = shape('x' => 4, 'y' => 6);
  $p2 = shape('x' => 9, 'y' => 2);
  \var_dump(distance_between_2_Points($p1, $p2));
}

run();
