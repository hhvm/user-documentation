<?hh

namespace Hack\UserDocumentation\Generics\Subtypes\Examples\Immutable;

function addRandomToArray(array<num> $x): void {
  $x[] = 3.2; // this is a copy, not a reference
}

function createArray(): array<int> {
  return array(3);
}

function run(): void {
  $arr = createArray(); // we have a array<int>
  // typechecker CAN guarantee array<int> now since what is received by
  // addRandomToArray() is a copy (passed-by-value)
  addRandomToArray($arr);
  var_dump($arr); // Still only going to contain 3, not the 3.2.
}

run();
