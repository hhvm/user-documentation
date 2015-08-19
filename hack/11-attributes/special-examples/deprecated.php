<?hh

namespace Hack\UserDocumentation\Attributes\Special\Examples\Deprecated;

class A {
  public function foo(): int {
    return 4;
  }

  <<__Deprecated("Call baz() instead")>>
  public function bar(): string {
    return "Deprecated";
  }

  public function baz(): string {
    return "Not Deprecated";
  }
}

class B extends A {
  <<__Override>>
  public function bar(): string {
    return "Not Deprecated";
  }
}

function test_deprecated(): void {
  $a = new A();
  //var_dump($a->bar()); // typechecker will throw error telling you to call baz
  $b = new B();
  var_dump($b->bar()); // This is ok; overrides do not inherit deprecation
}

test_deprecated();
