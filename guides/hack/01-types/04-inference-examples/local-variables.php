<?hh

namespace Hack\UserDocumentation\Types\Inference\Examples\LocalVariables;

function foo(): int {
  $a = str_shuffle("ABCDEF"); // $a is a string
  if (strpos($a, "A") === 0) {
    $a = 4; // $a is an int
  } else {
    $a = 2; // $a is an int
  }
  // Based on the flow of the program, $a is guaranteed to be an int at this
  // point, so it is safe to return as an int.
  return $a;
}

var_dump(foo());
