<?hh

namespace Hack\UserDocumentation\Functions\Varargs;

function sum_ints(int $val, int ...$vals): int {
  $result = $val;
  
  foreach ($vals as $v) {
    $result += $v;
  }
  return $result;
}
