<?hh

namespace Hack\UserDocumentation\Collections\Iterating\Examples\Modifying;

function run(): void {
  $vec = Vector {'A', 'B', 'C'};

  foreach ($vec as $val) {
    if ($val === 'B') {
      $vec[] = 'D';
      // Affects the container...
      \var_dump($vec);
    }
    //... but not the foreach ...
    \var_dump($val);
  }
  // ... and does affect the outside
  \var_dump($vec);
}

run();
