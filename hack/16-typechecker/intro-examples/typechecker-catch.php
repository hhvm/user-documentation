<?hh

namespace Hack\UserDocumentation\TypeChecker\Intro\Examples\TypecheckerCatch;

class A {
  public function foo() { return 2; }
}

function failing($x) {
  $a = new A();
  if ($x === 4) {
    $a = null;
  }
  // $a being null would only be caught BEFORE runtime
  //   typechecker-catch.php:21:7,9: You are trying to access the member foo
  //                                 but this object can be null. (Typing[4064])
  //   typechecker-catch.php:12:10,13: This is what makes me believe it can be
  //                                   null
  //
  // Commenting out so typechecker examples pass. Uncomment to see error above
  // $a->foo();
}

failing(4);
