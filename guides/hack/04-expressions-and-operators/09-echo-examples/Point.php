<?hh // strict

namespace Hack\UserDocumentation\ExprAndOps\Echo\Examples\Point;

class Point {
  private float $x;
  private float $y;

  public function __construct(num $x = 0, num $y = 0) {
    $this->x = (float)$x;
    $this->y = (float)$y;
  }

  public function __toString(): string {
    return '(' . $this->x . ',' . $this->y . ')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(20.5, 30.33);
  echo $p1 . "\n";  // implicit call to __toString()
}
