<?hh // strict

namespace Hack\UserDocumentation\Functions\Definition\Examples\Varargs;

function maximum(int $val1, int ...$vals): int {
  $retVal = $val1;
  foreach ($vals as $e) {
    if ($e > $retVal) $retVal = $e;
  }
  return $retVal;
}

<<__EntryPoint>>
function main(): void {
  echo "max = ".maximum(100)."\n";
  echo "max = ".maximum(100, 75)."\n";
  echo "max = ".maximum(100, 93, 124)."\n";
}
