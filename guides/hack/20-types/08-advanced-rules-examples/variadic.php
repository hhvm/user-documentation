<?hh

namespace Hack\UserDocumentation\Types\AdvancedRules\Examples\Variadic;

function foo(int ...$args): vec<int> {
  $ret = vec[];
  foreach ($args as $arg) {
    $ret[] = $arg;
  }
  return $ret;
}

function bar(): void {
  \var_dump(foo(1, 2, 3, 4));
}

bar();
