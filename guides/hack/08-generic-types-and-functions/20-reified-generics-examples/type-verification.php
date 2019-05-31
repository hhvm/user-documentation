<?hh

namespace Hack\UserDocumentation\Generics\ReifiedGenerics\Examples\TypeVerification;

class C<reify T> {}

function f(C<int> $c): void {}

<<__EntryPoint>>
function main(): void {
  $c1 = new C<int>();
  f($c1); // success
  $c2 = new C<string>();
  f($c2); // parameter type hint violation
}
