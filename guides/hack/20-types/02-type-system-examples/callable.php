<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Call;

function use_callable(
  Vector<int> $vec,
  (function(int) : ?int) $callback,
): Vector<?int> {
  $ret = Vector {};
  foreach ($vec as $item) {
    $ret[] = $callback($item);
  }
  return $ret;
}

function ts_callable(): void {
  $callable = function(int $i): ?int {
    return $i % 2 === 0 ? $i + 1 : null;
  };
  var_dump(use_callable(Vector {1, 2, 3}, $callable));
}

ts_callable();

// Returns
/*
object(HH\Vector)#3 (3) {
  [0]=>
  NULL
  [1]=>
  int(3)
  [2]=>
  NULL
}
*/
