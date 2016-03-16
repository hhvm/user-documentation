<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\ArrayKey;

class A {
  protected float $x;
  public string $y;

  public function __construct(float $x) {
    $this->x = $x;
    $this->y = "Day";
  }
  public function foo(bool $b): float {
    return $b ? 2.3 * $this->x : 1.1 * $this->x;
  }
}

// This function can return either a string or an int since it is typed to
// return an arraykey
function bar(): arraykey {
  // local variables are inferred, not explicitly typed
  $a = new A(0.9);
  if ($a->foo(true) > 8.0) {
    return "Good " . $a->y;
  }
  return 5;
}

var_dump(bar());
