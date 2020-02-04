<?hh

namespace Hack\UserDocumentation\Examples\IntBox;

class IntBox {
  private int $x;

  public function __construct(int $x) {
    $this->x = $x; // Assigning to property.
  }

  public function getX(): int {
    return $this->x; // Accessing property.
  }
}

<<__EntryPoint>>
function main(): void {
  $ib = new IntBox(42);
  $x = $ib->getX(); // Calling instance method.
}
