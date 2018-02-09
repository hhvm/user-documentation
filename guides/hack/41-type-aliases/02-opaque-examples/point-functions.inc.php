<?hh

namespace Hack\UserDocumentation\TypeAliases\Opaque\Examples\AliasNoConstraint;

// point-functions.php - Point's supporting functions

require_once 'point.inc.php';

function distance_between_2_Points(Point $p1, Point $p2): float {
  $dx = getX($p1) - getX($p2);
  $dy = getY($p1) - getY($p2);
  return \sqrt($dx*$dx + $dy*$dy);
}
