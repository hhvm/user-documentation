<?hh

namespace Hack\UserDocumentation\Attributes\Special\Examples\Override;

class A {
  protected function foo(): void {}
}

class B extends A {
  <<__Override>>
  protected function foo(): void {}
}

class C extends A {
  // Adding __Override here would throw a typechecker error since there is no
  // bar() in A
  //<<__Override>>
  protected function bar(): void {}
}
