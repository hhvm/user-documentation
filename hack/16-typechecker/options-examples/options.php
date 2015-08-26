<?hh // strict

namespace Hack\UserDocumentation\TypeChecker\Options\Examples\Options;

class VeryUniqueClass {
  public function foo(): int {
    return 4;
  }
}

class VeryUniqueGenericClass<T> {
  public function __construct(public T $x) {}
  public function VeryUniqueMethod(VeryUniqueClass $a): ?T {
    return $a->foo() === 4 ? $this->x : null;
  }
}

function VeryUniqueFunction(): void {
  $a = new VeryUniqueClass();
  $b = new VeryUniqueGenericClass("Hello");
  $b->VeryUniqueMethod($a);
  $b = new VeryUniqueGenericClass(3);
  $b->VeryUniqueMethod($a);
}

class VeryUniqueClassChild extends VeryUniqueClass {}
