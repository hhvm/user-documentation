<?hh

namespace Hack\UserDocumentation\ExpAndOps\StringConcatenation\Examples\Point;

class Point {
  private float $x;
  private float $y;

  public function __construct(num $x = 0, num $y = 0) {
    $this->x = (float)$x;
    $this->y = (float)$y;
  }

  public function __toString(): string {
    return '('.$this->x.','.$this->y.')';
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $p1 = new Point(20, 30);
  /* HH_FIXME[4067] implicit __toString() is now deprecated */
  echo $p1."\n"; // implicit call to __toString()
}
