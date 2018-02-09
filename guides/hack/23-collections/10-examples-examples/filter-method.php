<?hh

namespace Hack\UserDocumentation\Collections\Examples\Examples\FilterM;

function filter_evens(Set<int> $numbers): Set<int> {
  return $numbers->filter($x ==> $x % 2 === 0);
  // We used a lambda above. This could have also been written as:
  //return $numbers->filter(function (int $x): bool {return $x % 2 === 0;});
}

function run(): void {
  $numbers = Set {0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10};
  \var_dump(filter_evens($numbers));
}

run();
