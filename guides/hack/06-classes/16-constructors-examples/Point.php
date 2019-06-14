<?hh // strict

namespace Hack\UserDocumentation\Classes\Constructors\Examples\Point;

class Point {
  private static int $pointCount = 0; // static property with initializer
  private float $x;           // instance property
  private float $y;           // instance property

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x;         // access instance property
    $this->y = (float)$y;         // access instance property
    ++Point::$pointCount;           // include new Point in Point count
  }

  public function __toString(): string { // instance method
    return '(' . $this->x . ',' . $this->y . ')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(2.3);
  echo "\$p1 is $p1\n";
}
