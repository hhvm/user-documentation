<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Primitive;

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

function bar(): string {
  // local variables are inferred, not explictly typed
  $a = new A();
  if ($a->foo(true) > 8.0) {
    return "Good " . $a->y;
  }
  return "Bad " . $a->y;
}

var_dump(bar());
