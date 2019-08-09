<?hh // strict

namespace Hack\UserDocumentation\Statements\Return\Examples\Various;

function average_float(float $p1, float $p2): float {
  return ($p1 + $p2) / 2.0;
}

type IdSet = shape('id' => ?string, 'url' => ?string, 'count' => int);
function get_IdSet(): IdSet {
  return shape('id' => null, 'url' => null, 'count' => 0);
}

class Point {
  private float $x;
  private float $y;
  public function __construct(num $x = 0, num $y = 0) {
    $this->x = (float)$x; // sets private property $x
    $this->y = (float)$y; // sets private property $y
  } // no return statement
  public function move(num $x = 0, num $y = 0): void {
    $this->x = (float)$x; // sets private property $x
    $this->y = (float)$y; // sets private property $y
    return; // return nothing
  }
  // ...
}
