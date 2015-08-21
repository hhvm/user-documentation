<?hh

namespace Hack\UserDocumentation\Types\Inference\Examples\Unresolved;

function foo(): arraykey {
  $a = str_shuffle("ABCDEF"); // $a is a string
  if (strpos($a, "A") === 0) {
    $a = 4; // $a is an int
  } else {
    $a = "Hello"; // $a is string
  }
  // Based on the flow of the program, at this point $a is either an int or
  // string. You have an unresolved type; or, to look at it another way, you
  // the union of an int and string. So you can only perform operations that
  // can be performed on both of those types.

  //var_dump($a + 20); // Nope. This isn't good for a string

  $arr = array();
  $arr[$a] = 4; // Fine. Since an array key can be an int or string

  // arraykey is fine since it is either an int or string
  return $a;
}

var_dump(foo());
