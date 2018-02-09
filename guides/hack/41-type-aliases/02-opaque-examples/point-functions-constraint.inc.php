<?hh

namespace Hack\UserDocumentation\TypeAliases\Opaque\Examples\AliasConstraint;

// point-functions-constraint.inc.php - Point's supporting functions

require_once 'point-constraint.inc.php';

function distance_between_2_Points(Point $p1, Point $p2): float {
  $dx = getX($p1) - getX($p2);
  $dy = getY($p1) - getY($p2);
  return \sqrt($dx*$dx + $dy*$dy);
}

function distance_between_2_Points_tuple((int, int) $t1,
                                         (int, int) $t2): float {
  $dx = $t1[0] - $t2[0];
  $dy = $t1[1] - $t2[1];
  return \sqrt($dx*$dx + $dy*$dy);
}
