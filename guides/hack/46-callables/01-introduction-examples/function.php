<?hh

namespace Hack\UserDocumentation\Callables\Intro\Examples\Func;

function add_or_mult(int $a, bool $b): int {
  if ($b) {
    return $a + $a;
  }
  return $a * $a;
}

function my_math((function(int, bool): int) $callback, int $a, bool $b): ?int {
  if ($a < 0) {
    return null;
  }
  return $callback($a, $b);
}

function run(): void {
  var_dump(
    my_math(fun(
      '\Hack\UserDocumentation\Callables\Intro\Examples\Func\add_or_mult'
      ),
      3, true)
  );
  var_dump(
    my_math(fun(
      '\Hack\UserDocumentation\Callables\Intro\Examples\Func\add_or_mult'
      ),
      3, false)
  );
  var_dump(
    my_math(fun(
      '\Hack\UserDocumentation\Callables\Intro\Examples\Func\add_or_mult'
      ),
      -1, false)
  );
}

run();
