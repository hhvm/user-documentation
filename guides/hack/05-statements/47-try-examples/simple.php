<?hh // strict

namespace Hack\UserDocumentation\Statements\Try\Examples\Simple;

function do_it(int $x, int $y): void {
  try {
    $result = $x/$y;
    echo "\$result = $result\n";
    // ...
  }
  /*
  catch (\HH\Lib\Math\DivisionByZeroException $ex) {
    echo "Caught a DivisionByZeroException\n";
    // ...
  }
  */
  catch (\Exception $ex) {
    echo "Caught an Exception\n";
    // ...
  }
}

<<__EntryPoint>>
function main(): void {
  do_it(100, 5);
//  do_it(6, 0);
}
