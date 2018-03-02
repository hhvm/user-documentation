<?hh

namespace Hack\UserDocumentation\Collections\Iterating\Examples\Reference;

function run(): void {
  $arr = array ('A', 'B', 'C');
  \var_dump($arr);
  /* HH_IGNORE_ERROR[4225] this is not supported in Hack, but the example is
   * still illustrative */
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
