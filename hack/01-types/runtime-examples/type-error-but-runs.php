<?hh

namespace Hack\UserDocumentation\Types\Runtime\Examples\Runs;

// Even though we specify that the function is void, HHVM will still allow
// us to return an int with no problem.
function foo(int $x): void {
  // Use UNSAFE to silence the typechecker error that would occur here so
  // the you can run the example and see
  // UNSAFE
  return $x * 2;
}

var_dump(foo(2));
