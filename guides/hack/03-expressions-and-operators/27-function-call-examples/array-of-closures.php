<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\FunctionCall\Examples\Closures;

<<__EntryPoint>>
function main(): void {
  $table = vec[
    (
      function(int $p) {
        return $p * 2;
      }
    ), // doubles
    (
      function(int $p) {
        return $p * 5;
      }
    ), // times 5
  ];

  $incr = new Incrementer();

  $v = $table[$incr->postIncr()]($incr->value()); // eval is L-to-R
  echo "\$v = $v\n";

  $v = $table[$incr->value()]($incr->preIncr()); // eval is L-to-R
  echo "\$v = $v\n";
}

class Incrementer {
  private int $counter = 0;
  public function postIncr(): int {
    $ret = $this->counter;
    $this->counter++;
    return $ret;
  }
  public function preIncr(): int {
    $this->counter++;
    return $this->counter;
  }
  public function value(): int {
    return $this->counter;
  }
}
