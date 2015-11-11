<?hh

namespace Hack\UserDocumentation\Callables\Intro\Examples\Closure;

function my_math((function(int, bool): int) $callback, int $a, bool $b): ?int {
  if ($a < 0) {
    return null;
  }
  return $callback($a, $b);
}

function run(): void {
  $callback = function (int $a, bool $b): int {
    if ($b) {
      return $a + $a;
    }
    return $a * $a;
  };
  var_dump(my_math($callback, 3, true));
  var_dump(my_math($callback, 3, false));
  var_dump(my_math($callback, -1, false));
}

run();
