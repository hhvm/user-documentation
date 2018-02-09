<?hh

namespace Hack\UserDocumentation\Tuples\Introduction\Examples\Initializers;

class A {
  private $inst = tuple(2, "hi");
  public static $stat = tuple(array(1, 2), Vector {3, 4});
}

function run(): void {
  \var_dump(new A());
  \var_dump(A::$stat);
}

run();
