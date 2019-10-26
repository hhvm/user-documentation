<?hh // strict

namespace Hack\UserDocumentation\Classes\Constructors\Examples\ParmVisibiity;

class C2 {
  public function __construct(
    protected int $pr1,
    private int $p2,
    public int $pr2,
  ) {
  }
}
