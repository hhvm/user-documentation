<?hh // strict

namespace Hack\UserDocumentation\Types\String\Examples\ObjectToString;

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

<<__Entrypoint>>
function main(): void {
  $p1 = new Point(1.2, 3.3);
  echo "\$p1 = " . $p1 . "\n";
}
