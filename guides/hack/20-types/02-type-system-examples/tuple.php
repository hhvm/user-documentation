<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Tup;

// You don't use the keyword tuple when annotating with one
// You do use the keyword tuple when forming one.
function q_and_r(int $x, int $y): (int, int, bool) {
  return tuple(\round($x / $y), $x % $y, $x % $y === 0);
}

function ts_tuple(): void {
  // Tuples lend themselves very well to list()
  list($q, $r, $has_remainder) = q_and_r(5, 2);
  \var_dump($q);
  \var_dump($r);
  \var_dump($has_remainder);
}

ts_tuple();
