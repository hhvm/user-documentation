<?hh // strict

namespace Hack\UserDocumentation\Functions\Calling\Examples\Recursion;

function factorial(int $i): int {
  return ($i > 1) ? $i * factorial($i - 1) : $i;
}

<<__Entrypoint>>
function main(): void {
  for ($i = 0; $i <= 10; ++$i) {
    \printf("%2d! = %d\n", $i, factorial($i));
  }
}
