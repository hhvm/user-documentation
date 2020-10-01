<?hh

namespace Hack\UserDocumentation\Statements\For\Examples\TableOfSquares;

<<__EntryPoint>>
function main(): void {
  for ($i = 1; $i <= 5; ++$i) {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
  }

  $i = 1;
  for (; $i <= 5; ) {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  }

  $i = 1;
  for (; ; ) {
    if ($i > 5)
      break;
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  }
}
