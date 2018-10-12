<?hh // strict

namespace Hack\UserDocumentation\Generics\TypeConstraints\Examples\MaxVal;

function max_val<T as num>(T $p1, T $p2): T {
  return $p1 > $p2 ? $p1 : $p2;
}

<<__Entrypoint>>
function main(): void {
  echo "max_val(10, 20) = " . max_val(10, 20) . "\n";
  echo "max_val(15.6, -20.78) = " . max_val(15.6, -20.78) . "\n";
}
