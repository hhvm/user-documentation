<?hh

namespace Hack\UserDocumentation\Types\Refining\Examples\Unresolved;

interface I {
  public function i_method(): bool;
}

abstract class Base {
  abstract public function foo(): string;
}

class Child1 extends Base implements I {
  <<__Override>>
  public function foo(): string {
    return "Child1";
  }
  public function i_method(): bool {
    return true;
  }
}

class Child2 extends Base {
  <<__Override>>
  public function foo(): string {
    return "Child2";
  }
}

function bar(Base $b): void {
  if ($b instanceof I) { // refine $b to interface I, but makes $b unresolved
    echo $b->i_method();
  }
  // This is a type error!
  // Given the instanceof check above, we have now made $b unresolved, a union
  // between a type of I and Base. So we can only call methods common to both.
  // which in this case there are none.
  //echo $b->foo();
}

function unresolved(): void {
  $c = new Child1();
  bar($c);
}

unresolved();
