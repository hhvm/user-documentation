<?hh

namespace Hack\UserDocumentation\Collections\Iterating\Examples\FEach;

function run(): void {
  $vec = Vector {'A', 'B', 'C'};
  $map = Map {'A' => 1, 'B' => 2};
  $set = Set {800, 900, 1000};
  $pair = Pair {'A', 'B'};

  foreach ($vec as $val) {
    \var_dump($val);
  }

  foreach ($map as $key => $val) {
    \var_dump($key);
    \var_dump($val);
  }

  foreach ($set as $val) {
    \var_dump($val);
  }

  foreach ($pair as $key => $val) {
    \var_dump($key);
    \var_dump($val);
  }
}

run();
