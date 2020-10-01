<?hh

namespace Hack\UserDocumentation\Statements\Do\Examples\TableOfSquares;

<<__EntryPoint>>
function main(): void {
  $i = 1;
  do {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  } while ($i <= 10);
}
