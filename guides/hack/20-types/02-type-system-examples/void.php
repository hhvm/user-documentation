<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Void;

class A {
  protected float $x;
  public string $y;

  public function __construct() {
    $this->x = 4.0;
    $this->y = "Day";
  }
  public function foo(bool $b): float {
    return $b ? 2.3 * $this->x : 1.1 * $this->x;
  }
}

// void can only be used as a return types
function bar(): void {
  // local variables are inferred, not explicitly typed
  $a = new A();
  if ($a->foo(true) > 8.0) {
    echo "Good " . $a->y;
  } else {
    echo "Bad " . $a->y;
  }
}

bar();
