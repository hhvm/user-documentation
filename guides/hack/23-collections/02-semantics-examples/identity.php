<?hh

namespace Hack\UserDocumentation\Collections\Semantics\Examples\Identity;

function run(): void {
  $vecA = Vector {1, 2, 3};
  $vecB = Vector {1, 2, 3};
  $vecC = $vecA;
  $setA = Set {1, 2, 3};
  $setB = Set {3, 2, 1};
  $setC = $setB;
  $mapA = Map {1 => 'A', 2 => 'B'};
  $mapB = Map {2 => 'B', 1 => 'A'};

  \var_dump($vecA === $vecB); // false, not the same object
  \var_dump($vecA === $vecC); // true, the same object
  \var_dump($setA === $setB); // false, not the same object
  \var_dump($setA === $setC); // false, not the same object
  \var_dump($setB === $setC); // true, the same object
  \var_dump($mapA === $mapB); // false, not the same object
}

run();
