<?hh // strict

namespace Hack\UserDocumentation\Classes\Methods\Examples\Point;

class Point {
  private static int $pointCount = 0; // static property with initializer
  private float $x;           // instance property
  private float $y;           // instance property

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x;         // access instance property
    $this->y = (float)$y;         // access instance property
    ++Point::$pointCount;           // include new Point in Point count
  }

  public function move(num $x = 0, num $y = 0): void { // instance method
    $this->x = (float)$x;
    $this->y = (float)$y;
  }

  public static function get_point_count(): int { // static method
    return Point::$pointCount;    // access static property
  }

  public function __toString(): string { // instance method
    return '(' . $this->x . ',' . $this->y . ')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(3.4, 5.6);
  $p2 = new Point();
  $p3 = new Point();
  $p2->move(-2.2, -4);
  echo "\$p2 is $p2\n";  // implicit call to __toString()
  echo "The number of Points is " . Point::get_point_count() . "\n";
}
