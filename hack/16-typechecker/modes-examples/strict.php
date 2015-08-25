<?hh // strict

namespace Hack\UserDocumentation\TypeChecker\Modes\Examples\Strict;

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
  // In partial, this didn't have to be annotated. In strict, it does.
  public function notTyped(string $z): string {
    return "Hello" . $z;
  }
}

function foo(): void {
  $a = 1;
  // This will typecheck error with
  //   an int does not allow array append (Typing[4006])
  // Comment out so examples pass typechecking
  // $a[] = 2;
}

function bar(): int {
  $a = new A();
  // This is typechecked, so we can't pass an string-y int; we must pass a
  // string
  echo $a->notTyped("3");

  // Cannot call these in strict mode
  //    Unbound name:
  //       Hack\UserDocumentation\TypeChecker\Modes\Examples\NonHack\B
  //       (an object type) (Naming[2049])
  // $b = NonHack\B::getSomeInt();
  //    Unbound name:
  //       Hack\UserDocumentation\TypeChecker\Modes\Examples\NonHack\php_func
  //       Typing[4107])
  // echo NonHack\php_func(3, $b);
  $i = $a->getX(100);
  // But we can make assertions to satisfy the typechecker
  // Without this, we would get:
  //   Invalid return type (Typing[4110])
  //     This is an int
  //     It is incompatible with a nullable type
  invariant(is_int($i), "I know this will be an integer");
  return $i;
}

// This can't be in strict mode either. You need to put this in partial file
// and include it from this file
// bar();
