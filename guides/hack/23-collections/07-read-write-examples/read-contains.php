<?hh

namespace Hack\UserDocumentation\Collections\ReadWrite\Examples\ReadContains;

function run(): void {
  $vec = Vector {'A', 'B', 'C'};
  if ($vec->containsKey(2)) {
    var_dump($vec[2]); // 'C'
  } else {
    var_dump('Move on, but at least no OutOfBoundsException');
  }
  // We can avoid of OutOfBoundsException by using contains()
  if ($vec->containsKey(3)) {
    var_dump($vec[3]); // Doesn't exist
  } else {
    var_dump('Move on, but at least no OutOfBoundsException');
  }
}

run();
