<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\ThisStatic;

class A {
  protected float $x;
  public string $y;

  // typechecker error if constructor isn't final because new static() cannot
  // be called to return an instance of a subclass
  final protected function __construct() {
    $this->x = 4.0;
    $this->y = "Day";
  }

  public function foo(bool $b): float {
    return $b ? 2.3 * $this->x : 1.1 * $this->x;
  }

  // The this type annotation allows you to return an instance of a type
  public static function create(int $x): this {
    $instance = new static();
    if ($x < 4) {
      $instance->x = floatval($x);
    }
    return $instance;
  }
}

function bar(): string {
  // local variables are inferred, not explictly typed
  // There is no public constructor, so call A's create() method
  $a = A::create(2);
  if ($a->foo(true) > 8.0) {
    return "Good " . $a->y;
  }
  return "Bad " . $a->y;
}

var_dump(bar());
