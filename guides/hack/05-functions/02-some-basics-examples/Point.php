<?hh // strict

namespace Hack\UserDocumentation\Functions\Introduction\Examples\Point;

class Point {
  private float $x; // instance property
  private float $y; // instance property

  public function __construct(num $x = 0, num $y = 0) { // instance method
    $this->x = (float)$x; // access instance property
    $this->y = (float)$y; // access instance property
  }

  public function move(num $x = 0, num $y = 0): void { // instance method
    $this->x = (float)$x;
    $this->y = (float)$y;
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p = new Point();
  $p->move(-2.2, -4);
}
