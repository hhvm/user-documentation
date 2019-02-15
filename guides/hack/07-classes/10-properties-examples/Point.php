<?hh // strict

namespace Hack\UserDocumentation\Classes\Properties\Examples\Point;

class Point {
  private static int $pointCount = 0; // static property with initializer
  private float $x;           // instance property
  private float $y;           // instance property

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x;         // access instance property
    $this->y = (float)$y;         // access instance property
    ++Point::$pointCount;           // include new Point in Point count
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(3.4, 5.6);
}
