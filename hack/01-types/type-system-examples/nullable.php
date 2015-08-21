<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Nullable;

class A {
  protected float $x;
  public string $y;

  public function __construct() {
    $this->x = 4.0;
    $this->y = "Day";
  }

  // We can pass a nullable as a parameter as well as being nullable on the
  // return type. Properties can also be nullable
  public function foo(?bool $b): ?float {
    return ($b || $b === null) ? 2.3 * $this->x : null;
  }
}

// The ? means that the function can return null in addition to the string
function bar(): ?string {
  // local variables are inferred, not explictly typed
  $a = new A();
  if ($a->foo(null) === null) {
    return null;
  }
  return "Good " . $a->y;
}

var_dump(bar());
