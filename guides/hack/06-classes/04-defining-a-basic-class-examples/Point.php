<?hh // strict

namespace Hack\UserDocumentation\Classes\Basics\Examples\Point;

class Point {
  private float $x; // instance property
  private float $y; // instance property

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x; // access instance property
    $this->y = (float)$y; // access instance property
  }

  public function move(num $x, num $y): void { // instance method
    $this->x = (float)$x;
    $this->y = (float)$y;
  }

  public function __toString(): string { // instance method
    return '('.$this->x.','.$this->y.')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(3.4, 5.6);
  $p2 = new Point(3.4);
  $p3 = new Point();

  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p1 is $p1\n"; // implicit call to __toString()
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p2 is $p2\n"; //   "          "         "
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo "\$p3 is $p3\n"; //   "          "         "
}
