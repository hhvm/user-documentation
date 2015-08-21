<?hh

namespace Hack\UserDocumentation\Types\Refining\Examples\Obj;

interface I {
  public function foo(): string;
}

class Base implements I {
  public function foo(): string {
    return "Base";
  }
}

class Child extends Base {
  <<__Override>>
  public function foo(): string {
    return "Child";
  }
}

function bar(Base $b): Child {
  if ($b instanceof Child) { // refine $b to Child, a subclass of Base
    echo $b->foo(); // "Child"
    return $b;
  }
  echo $b->foo(); // "Base"
  return new Child();
}

function baz(I $i): Child {
  // guarantee that the interface will be a Child
  invariant($i instanceof Child, "Not Child");
  echo $i->foo(); // "Child"
  return $i;
}

function refine_object(): void {
  $c = new Child();
  bar($c);
  bar(new Base());
  baz($c);
}

refine_object();
