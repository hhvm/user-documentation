<?hh

namespace Hack\UserDocumentation\Types\Refining\Examples\Nullable;

function foo(?int $x): int {
  $a = 4;
  if ($x) { // refine $x to just an int by verifying it is not null
    return $x + $a; // guaranteed that $x is not null now
  }
  return $a;
}

var_dump(foo(5));
