<?hh

namespace Hack\UserDocumentation\TypeAliases\Opaque\Examples\AliasConstraint;

// test-point-constraint.php - User code that tests type Point

require_once 'point-functions-constraint.inc.php';

function run(): void {
  $p1 = createPoint(5, 3);
  var_dump($p1);
  $p2 = createPoint(9, -5);
  var_dump($p2);
  $dist = distance_between_2_Points($p1, $p2);
  echo "distance between points is " . $dist ."\n";
  // Given we have a constraint we can pass a Point to a function that takes
  // a tuple(int, int). This will typecheck.
  $will_type_check = distance_between_2_Points_tuple($p1, $p2);
  echo "distance between points is " . $will_type_check ."\n";
}

run();
