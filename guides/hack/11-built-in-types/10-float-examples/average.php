<?hh // strict

namespace Hack\UserDocumentation\Types\Float\Examples\Average;

function average_float(float $p1, float $p2): float {
  return ($p1 + $p2) / 2.0;
}

<<__EntryPoint>>
function main(): void {
  $val = 3e6;
  $result = average_float($val, 5.2E-2);
  echo "\$result is ".$result."\n";
}
