<?hh

namespace Hack\UserDocumentation\Functions\DefaultParam;

function add_value(int $x, int $y = 1): int {
  return $x + $y;
}
