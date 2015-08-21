<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\This;

// Need this attribute here because when using "new static()" on a class
// that is not marked final (e.g., may have subclasses), you need to make
// sure that all constructors are consistent with their arguments; otherwise
// "new static()" could throw a parameter count mismatch type error if create()
// was used to create an instance of a subclass. Without this attribute, the
// typechecker will throw an error. You could have also marked the class or
// constructor as "final" to avoid this too.
<<__ConsistentConstruct>>
class A {
  protected float $x;
  public string $y;

  protected function __construct() {
    $this->x = 4.0;
    $this->y = "Day";
  }

  public function foo(bool $b): float {
    return $b ? 2.3 * $this->x : 1.1 * $this->x;
  }

  // The this type annotation allows you to return an instance of a type
  // the this type is also good for chaining method calls on classes that
  // have children classes
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
