<?hh

namespace Hack\UserDocumentation\Types\Refining\Examples\Mixed;

function foo(mixed $x): int {
  $a = 4;
  if (is_int($x)) { // refine $x to int by checking to see if $x is an int
    return $x + $a;
  } else if (is_bool($x)) {
    return (int) $x + $a; // know it is a bool, so can do safe cast
  }
  return $a;
}

var_dump(foo(true));
