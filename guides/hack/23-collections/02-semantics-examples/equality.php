<?hh

namespace Hack\UserDocumentation\Collections\Semantics\Examples\Equality;

function run(): void {
  $vecA = Vector {1, 2, 3};
  $vecB = Vector {1, 2, 3};
  $vecC = Vector {4, 5, 6};
  $vecD = Vector {2, 1, 3};
  $setA = Set {1, 2, 3};
  $setB = Set {3, 2, 1};
  $mapA = Map {1 => 'A', 2 => 'B'};
  $mapB = Map {2 => 'B', 1 => 'A'};

  \var_dump($vecA == $vecB); // true
  \var_dump($vecA == $vecC); // false, different values
  \var_dump($vecA == $vecD); // false, same values, but different order
  \var_dump($setA == $setB); // true, same values, order doesn't matter
  \var_dump($mapA == $mapB); // true, ordering of keys doesn't matter
}

run();
