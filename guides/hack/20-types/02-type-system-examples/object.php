<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Obj;

class Z {
  public function create_A(): A {
    return new A();
  }
}

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

// We are taking a Z and returning an object of type A
function baz(Z $z): A {
  return $z->create_A();
}

function bar(): string {
  // local variables are inferred, not explicitly typed
  $z = new Z();
  $a = baz($z);
  if ($a->foo(true) > 8.0) {
    return "Good " . $a->y;
  }
  return "Bad " . $a->y;
}

var_dump(bar());
