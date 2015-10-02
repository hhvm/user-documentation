<?hh

namespace Hack\UserDocumentation\Collections\Semantics\Examples\Liust;

function run(): void {
  $vecA = Vector {1, 2, 3};
  $setA = Set {0, 1, 2};
  $mapA = Map {1 => 'A', 0 => 'B'};
  $setB = Set {200, 300};
  list($v1, $v2, $v3) = $vecA;
  list($s1, $s2, $s3) = $setA;
  list($m1, $m2) = $mapA;
  try {
    list($x, $y) = $setB;
  } catch (\OutOfBoundsException $ex) {
    var_dump($ex->getMessage());
  }
  var_dump($v1);
  var_dump($v2);
  var_dump($v3);
  var_dump($s1);
  var_dump($s2);
  var_dump($s3);
  var_dump($m1);
  var_dump($m2);
}

run();
