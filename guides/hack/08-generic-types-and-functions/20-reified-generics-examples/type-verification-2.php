<?hh

namespace Hack\UserDocumentation\Generics\ReifiedGenerics\Examples\TypeVerification2;

class C<reify T> {}

function f<reify T>(T $x): C<T> {
  return new C<int>();
}

<<__EntryPoint>>
function main(): void {
  f<int>(1); // success
  f<int>("yep"); // parameter type hint violation
  f<string>("yep"); // return type hint violation
}
