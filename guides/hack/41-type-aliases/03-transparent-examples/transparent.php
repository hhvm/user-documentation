<?hh

namespace Hack\UserDocumentation\TypeAliases\Transparent\Examples\Converted;

type Matrix<T> = Vector<Vector<T>>;

function add<T as num>(Matrix<T> $m1, Matrix<T> $m2): Matrix<num> {
  // Assumes that $m1 and $m2 have the same dimensions; real code should have
  // better error detection and handling of course.
  $r = Vector {};
  foreach ($m1 as $i => $row1) {
    $new_row = Vector {};
    foreach ($row1 as $j => $val1) {
      $new_row[] = $val1 + $m2[$i][$j];
    }
    $r[] = $new_row;
  }

  return $r;
}

function get_m1(): Matrix<int> {
  // No conversion needed from these Vectors into the Matrix return type, since
  // the two are equivalent.
  return Vector { Vector { 1, 2 }, Vector { 3, 4 } };
}

function get_m2(): Vector<Vector<int>> {
  return Vector { Vector { 5, 6 }, Vector { 7, 8 } };
}

function run(): void {
  \var_dump(add(
    get_m1(),
    // get_m2() returns a Vector<Vector<int>>, and add() takes a Matrix<int>,
    // but no conversion is needed here since the two are equivalent.
    get_m2()
  ));
}

run();
