<?hh

namespace Hack\UserDocumentation\Types\AdvancedRules\Examples\Variadic;

// this typechecks, but the variadic type hint is not yet supported in HHVM
function foo(int ...$args): array<int> {
  $ret = array();
  foreach ($args as $arg) {
    $ret[] = $arg;
  }
  return $ret;
}

function bar(): void {
  var_dump(foo(1, 2, 3, 4));
}

bar();
