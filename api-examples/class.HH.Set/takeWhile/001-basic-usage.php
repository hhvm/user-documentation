<?hh

namespace Hack\UserDocumentation\API\Examples\Set\TakeWhile;

<<__EntryPoint>>
function basic_usage_main(): void {
  $s = Set {0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144};

  // Include values until we reach one over 10
  $s2 = $s->takeWhile($x ==> $x <= 10);
  \var_dump($s2);
}
