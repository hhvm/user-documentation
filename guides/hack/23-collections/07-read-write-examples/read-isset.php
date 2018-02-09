<?hh

namespace Hack\UserDocumentation\Collections\ReadWrite\Examples\ReadIsset;

// Be aware, isset() and empty() fail typechecking in strict mode.
function run(): void {
  $vec = Vector {'A', 'B', 'C'};
  if (isset($vec[2])) {
    \var_dump($vec[2]); // 'C'
  } else {
    \var_dump('Move on, but at least no OutOfBoundsException');
  }
  // We can avoid of OutOfBoundsException by using isset()
  if (isset($vec[3])) {
    \var_dump($vec[3]); // Doesn't exist
  } else {
    \var_dump('Move on, but at least no OutOfBoundsException');
  }
}

run();
