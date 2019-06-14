<?hh // strict

namespace Hack\UserDocumentation\Functions\Anonymous\Examples\Run;

class C {
  private (function (int): int) $af;
  public function __construct((function (int): int) $af) {
    $this->af = $af;
  }
  public function run(int $p): int {
    $tmp = $this->af;
  	return $tmp($p);
  }
}
