<?hh

namespace Hack\UserDocumentation\Collections\Iterating\Examples\Reference;

function run(): void {
  $arr = array ('A', 'B', 'C');
  // if $arr was a Vector instead, we would get a
  // Fatal error: Collection elements cannot be taken by reference
  \var_dump($arr);
  foreach ($arr as &$val) {
    \var_dump($val);
    if ($val === 'B') {
      $val = 'D';
    }
    \var_dump($arr);
  }

  // How to mimic the above
  $vec = Vector {'A', 'B', 'C'};
  \var_dump($vec);
  foreach ($vec as $key => $val) {
    \var_dump($val);
    if ($val === 'B') {
      $vec[$key] = 'D';
    }
    \var_dump($vec);
  }
}

run();
