// @example-start We want a complete example program so don't strip boilerplate.

namespace Hack\GettingStarted\MyFirstProgram;

<<__EntryPoint>>
function main(): noreturn{
  echo "Welcome to Hack!\n\n";

  \printf("Table of Squares\n" .
          "----------------\n");
  for ($i = -5; $i <= 5; ++$i) {
    \printf("  %2d        %2d  \n", $i, $i * $i);
  }
  \printf("----------------\n");
  exit(0);
}

