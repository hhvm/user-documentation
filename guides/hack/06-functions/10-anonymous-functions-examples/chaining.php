<?hh // strict

namespace Hack\UserDocumentation\Functions\Anonymous\Examples\Chaining;

<<__Entrypoint>>
function main(): void {
  $lam1 = $x ==> $y ==> $x + $y;
  $lam2 = $lam1(10);
  $res = $lam2(7);
  echo "\$res = $res\n";

  $res = $lam1(10)(7);
  echo "\$res = $res\n";
}
