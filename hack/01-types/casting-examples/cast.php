<?hh

namespace Hack\UserDocumentation\Types\Inference\Examples\Unresolved;

function cast(): bool {
  $a = "10";
  $a = (int) $a;
  $a = (bool) $a;
  // $a = (float) $a; // Not allowed, a cast from bool to float
  return $a;
}

var_dump(cast());
