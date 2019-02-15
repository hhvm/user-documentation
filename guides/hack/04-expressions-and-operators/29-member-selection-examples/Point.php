<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\MemberSelection\Examples\Point;

class Point {
  private float $x;
  private float $y;

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x;         // access instance property
    $this->y = (float)$y;         // access instance property
  }

  public function move(num $x = 0, num $y = 0): void { // instance method
    $this->x = (float)$x;         // access instance property
    $this->y = (float)$y;         // access instance property
  }

  public function __toString(): string { // instance method
    return '(' . $this->x . ',' . $this->y . ')'; // access instance properties
  }
  // ...
}

<<__Entrypoint>>
function main(): void {
  $p1 = new Point(3.4, 5.6);
  $p1->move(-2.2, -4);         // access instance method
}
