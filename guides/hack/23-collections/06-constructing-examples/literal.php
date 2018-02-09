<?hh

namespace Hack\UserDocumentation\Collections\Constructing\Examples\Literal;

function run(): void {
  $vec = Vector {'A', 'B', 'C'};
  $ivec = ImmVector {'A', 'B', 'C'};
  $map = Map {'A' => 1, 'B' => 2, 'C' => 3};
  $set = Set {'A', 'B', 'C'};
  $pair = Pair {'A', 'B'};

  \var_dump($vec);
  \var_dump($ivec);
  \var_dump($map);
  \var_dump($set);
  \var_dump($pair);
}

run();
