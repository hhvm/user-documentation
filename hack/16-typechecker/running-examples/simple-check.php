<?hh

namespace Hack\UserDocumentation\TypeChecker\Intro\Examples\Simple;

function a(int $x): int {
  return x + 1;
}
function main(): void {
  // simple-check.php:13:14,16: Invalid argument (Typing[4110])
  //   simple-check.php:5:12,14: This is an int
  //   simple-check.php:13:14,16: It is incompatible with a string
  // Uncomment this out to see the hh_client error
  // a("5");

  // No errors!
  a(5);
}

main();
