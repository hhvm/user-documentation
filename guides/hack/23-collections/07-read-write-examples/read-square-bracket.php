<?hh

namespace Hack\UserDocumentation\Collections\ReadWrite\Examples\ReadSquareBrack;

function run(): void {
  $vec = Vector {'A', 'B', 'C'};
  \var_dump($vec[1]); // 'B'

  $map = Map {'A' => 1, 'B' =>2};
  \var_dump($map['B']); // 2

  $pair = Pair {100, 200};
  \var_dump($pair[0]); // 100
}

run();
