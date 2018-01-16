<?hh

namespace Hack\UserDocumentation\Unsupported\References\Examples\Partial;

class A {
  public int $x;
  public function __construct(int $x) {
    $this->x = $x;
  }
  public function setX(int& $x): void {
    $this->x = $x;
  }
}

function foo(int& $x): void {
  $x++;
  $y = $x;
  $a = new A($x);
  $a->setX(&$y);
}

function bar(int& $x): void {
  $y = $x;
  $y = 5;
  $x = $y;
  foo(&$x);
}

function baz(): int {
  $x = 4;
  bar(&$x);
  return $x;
}

var_dump(baz()); // No typechecker errors. HHVM returns int(6)
