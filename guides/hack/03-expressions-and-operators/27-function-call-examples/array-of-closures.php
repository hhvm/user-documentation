<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\FunctionCall\Examples\Closures;

<<__EntryPoint>>
function main(): void {
  $table = vec[
    (int $p) ==> $p * 2, // doubler
    (int $p) ==> $p * 3, // tripler
    (int $p) ==> $p * 4, // quadrupler
  ];

  $seq = new Sequence();

  $v = $table[$seq->next()]($seq->next()); // eval is L-to-R
  echo "\$v = $v\n";

  $v = $table[$seq->next()]($seq->next()); // eval is L-to-R
  echo "\$v = $v\n";
}

class Sequence {
  private int $last = -1;
  public function next(): int {
    $this->last++;
    return $this->last;
  }
}
