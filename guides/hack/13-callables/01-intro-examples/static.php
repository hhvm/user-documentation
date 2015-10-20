<?hh

namespace Hack\UserDocumentation\Callables\Intro\Examples\Stat;

class A {
  public static function add_or_mult(int $a, bool $b): int {
    if ($b) {
      return $a + $a;
    }
    return $a * $a;
  }
}

function my_math((function(int, bool): int) $callback, int $a, bool $b): ?int {
  if ($a < 0) {
    return null;
  }
  return $callback($a, $b);
}

function run(): void {
  $callback = class_meth(A::class, 'add_or_mult');
  var_dump(my_math($callback, 3, true));
  var_dump(my_math($callback, 3, false));
  var_dump(my_math($callback, -1, false));
}

run();

