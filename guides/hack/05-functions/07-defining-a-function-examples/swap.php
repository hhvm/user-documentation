<?hh // strict

namespace Hack\UserDocumentation\Functions\Definition\Examples\Swap;

function swap(inout int $i1, inout int $i2): void {
  $temp = $i1;
  $i1 = $i2;
  $i2 = $temp;
}

<<__EntryPoint>>
function main(): void {
  $v1 = -10;
  $v2 = 123;
  echo "\$v1 = ".$v1.", \$v2 = ".$v2."\n";
  swap(inout $v1, inout $v2);
  echo "\$v1 = ".$v1.", \$v2 = ".$v2."\n";
}
