<?hh

namespace Hack\UserDocumentation\Collections\Iterating\Examples\Modifying;

function run(): void {
  $vec = Vector {'A', 'B', 'C'};

  try {
    foreach ($vec as $val) {
      if ($val === 'B') {
        // This will actually be allowed, but the next time through the loop
        // the InvalidOperationException will be thrown.
        $vec[] = 'D';
      }
      var_dump($vec);
      var_dump($val);
    }
  } catch (\InvalidOperationException $ex) {
    var_dump($ex->getMessage());
  }

  $set = Set {100, 200, 300};

  try {
    foreach ($set as $val) {
      if ($val === 300) {
        // This will actually be allowed, and even though this is the last
        // element in the set, we actually do the check in the foreach again so
        // the InvalidOperationException will be thrown.
        $set->remove(300);
      }
      var_dump($set);
      var_dump($val);
    }
  } catch (\InvalidOperationException $ex) {
    var_dump($ex->getMessage());
  }
}

run();
