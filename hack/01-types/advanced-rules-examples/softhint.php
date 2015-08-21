<?hh

namespace Hack\UserDocumentation\Types\AdvancedRules\Examples\SoftHint;

// HHVM will throw a warning instead of fatal if, for example, a bool is passed
// in
function foo(@int $x): bool {
  return $x < 5 ? true : false;
}

function call_foo(): void {
  foo(5);
  // Supress the actual typechecker error here.
  // UNSAFE
  foo(false);
}

call_foo();
