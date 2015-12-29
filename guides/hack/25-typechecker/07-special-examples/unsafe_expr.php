<?hh

namespace Hack\UserDocumentation\Typechecker\Special\Examples\UnsafeExpr;

function foo(string $num): int {
  // Without UNSAFE_EXPR, couldn't add stringy number to a number and then
  // return that result later.
  $x = /* UNSAFE_EXPR */ $num + 2;
  echo "More statements here...\n";
  return $x;
}

function run(): void {
  var_dump(foo("1"));
}

run();
