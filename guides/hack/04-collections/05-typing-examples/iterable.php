<?hh

namespace Hack\UserDocumentation\Collections\Typing\Examples\Iter;

// Given that this function takes an Iterable, you can pass any of
// our current concerte collection classes to this method
function take_iterable<T>(Iterable<T> $it): array<T> {
  return $it->toValuesArray();
}

function run(): void {
  $v = Vector {100, 200, 300};
  var_dump(take_iterable($v));
  $iv = ImmVector {400, 500, 600};
  var_dump(take_iterable($iv));
  $s = Set {'A', 'B'};
  var_dump(take_iterable($s));
  $is = ImmSet {'C', 'D'};
  var_dump(take_iterable($is));
  $m = Map {'A' => 'Z', 'B' => 'Y'};
  var_dump(take_iterable($m));
  $im = ImmMap {'C' => 'X', 'D' => 'W'};
  var_dump(take_iterable($im));
}

run();
