<?hh

namespace Hack\UserDocumentation\TypeChecker\Modes\Examples\Partial;

use \Hack\UserDocumentation\TypeChecker\Modes\Examples\NonHack as NonHack;

require __DIR__ . '/non-hack-code.php';

class A {
  private int $x;

  public function __construct() {
    $this->x = 9;
  }
  public function getX(int $y): ?int {
    return $y > 4 ? $this->x : null;
  }
  // You can even have non-type annotated code in the same class
  public function notTyped($z) {
    return "Hello" . $z;
  }
}

// Even though this function isn't type annotated, the inference of the
// typechecker still is in effect for locals
function foo() {
  $a = 1;
  // This will typecheck error with
  //   an int does not allow array append (Typing[4006])
  // Comment out so examples pass typechecking
  // $a[] = 2;
}

function bar(): int {
  $a = new A();
  // Not typechecked either. So we can pass an int and it will be converted to
  // a string by the runtime, luckily
  echo $a->notTyped(3);
  // The return value from this call is not typechecked since B is in a PHP file
  // The typechecker assumes we know what we are doing
  $b = NonHack\B::getSomeInt();
  echo NonHack\php_func(3, $b);
  $i = $a->getX($b);
  // But we can make assertions to satisfy the typechecker
  // Without this, we would get:
  //   Invalid return type (Typing[4110])
  //     This is an int
  //     It is incompatible with a nullable type
  invariant(is_int($i), "I know this will be an integer");
  return $i;
}

bar();
