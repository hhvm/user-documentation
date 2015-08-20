<?hh

namespace Hack\UserDocumentation\Types\Intro\Examples\Hack;

class Z {}
class A {
  public int $a;
  public int $b;

  public function __construct(int $a, int $b) {
    $this->a = $a;
    $this->b = $b;
  }

  public function foo(int $x, int $y): int {
    return $x * $this->a + $y * $this->b;
  }
}

function bar(A $a, int $x, int $y): int {
  return $a->foo($x, $y);
}

function baz(): void {
  $a = new A(2, 4);
  $z = new Z();
  var_dump(bar($a, 9, 4));
  // Did we really want to allow passing a stringy int? NO!
  // The typechecker will actually error here before you even run the program,
  // so you can catch problems before runtime.
  var_dump(bar($a, 8, "3"));
  // Did we really want to allow passing booleans? NO!
  // The typechecker will error here too.
  var_dump(bar($a, true, false));
  // This will throw a fatal at runtime
  // The typechecker will error here as well
  var_dump(bar($z, 1, 1));
}

baz();

/****

Type checker errors:

hack.php:29:23,25: Invalid argument (Typing[4110])
  hack.php:20:28,30: This is an int
  hack.php:29:23,25: It is incompatible with a string
hack.php:31:20,23: Invalid argument (Typing[4110])
  hack.php:20:20,22: This is an int
  hack.php:31:20,23: It is incompatible with a bool
hack.php:31:26,30: Invalid argument (Typing[4110])
  hack.php:20:28,30: This is an int
  hack.php:31:26,30: It is incompatible with a bool
hack.php:33:16,17: Invalid argument (Typing[4110])
  hack.php:20:14,14: This is an object of type
                     Hack\UserDocumentation\Types\Intro\Examples\Hack\A
  hack.php:26:8,14: It is incompatible with an object of type
                    Hack\UserDocumentation\Types\Intro\Examples\Hack\Z
*****/
