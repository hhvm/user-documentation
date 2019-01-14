<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Mixed;

class A {
  public float $x;
  protected string $y;

  public function __construct() {
    $this->x = 4.0;
    $this->y = "Day";
  }
  // mixed is the most lax type. Use it only when necessary
  public function foo(bool $b): mixed {
    return $b ? 2.3 * $this->x : $this->y;
  }
}

function bar(): string {
  // local variables are inferred, not explicitly typed
  $a = new A();
  $v = $a->foo(false);
  // Since A::foo() returns a mixed, we need to do various checks to make sure
  // that we let the typechecker know understand what is coming back.
  if (is_float($v)) {
    return "No String";
  }
  invariant($v is string, "Something went wrong if this isn't true");
  return "Good " . $v;
}

var_dump(bar());
