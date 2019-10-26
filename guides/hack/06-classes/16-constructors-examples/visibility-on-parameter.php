<?hh // strict

namespace Hack\UserDocumentation\Classes\Constructors\Examples\ParmVisibiity;

class C {
  protected int $pr1;
  public int $pr2;

  public function __construct(int $p1, private int $p2, int $p3) {
    $this->pr1 = $p1;
    $this->pr2 = $p3;
  }
}
