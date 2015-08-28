<?hh

namespace Hack\UserDocumentation\Attributes\Special\Examples\ConsistentConstrO;

<<__ConsistentConstruct>>
abstract class A {
}

class B extends A {
}

class C extends A {
  private int $x;

  // Even though we have __ConsistentConstruct on the parent class, we can
  // use __UNSAFE_Construct to override the consistent constructor requirement
  <<__UNSAFE_Construct>>
  public function __construct(int $x) {
    $this->x = $x;
    var_dump($this->x);
  }
}

function runMe(): void {
  $c = new C(5);
}

runMe();
