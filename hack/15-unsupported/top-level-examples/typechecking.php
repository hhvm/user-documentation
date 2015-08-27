<?hh

namespace Hack\UserDocumentation\Unsupported\TopLevel\Examples\Typechecking;

function foo(int $x): void {
  echo $x + $x;
}

foo(true); // No typechecking errors! But will fail at runtime.
