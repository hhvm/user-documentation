<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Num;

class A {
  protected num $x;
  public string $y;

  public function __construct(num $x) {
    $this->x = $x;
    $this->y = "Day";
  }
  public function foo(bool $b): num {
    return $b ? 2.3 * $this->x : 1.1 * $this->x;
  }
  // The $x property can be either a float or int
  public function setNum(num $x): void {
    $this->x = $x;
  }
}

function check(A $a): string {
  if ($a->foo(true) > 8.0) {
    return "Good " . $a->y;
  }
  return "Bad " . $a->y;
}

function bar(): string {
  // local variables are inferred, not explicitly typed
  // Setting the $x property in A to an int
  $a = new A(4);
  $ret = check($a);
  // Now setting to a float
  $a->setNum(0.4);
  $ret .= "##" . check($a);
  return $ret;
}

var_dump(bar());
