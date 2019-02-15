<?hh // strict

namespace Hack\UserDocumentation\Statements\While\Examples\TableOfSquares;

<<__EntryPoint>>
function main(): void {
  $i = 1;
  while ($i <= 10) {
    echo "$i\t".($i * $i)."\n"; // output a table of squares
    ++$i;
  }
}
