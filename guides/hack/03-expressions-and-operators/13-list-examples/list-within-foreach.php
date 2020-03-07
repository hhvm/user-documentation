<?hh // strict

namespace Hack\UserDocumentation\ExprAndOps\List\ListWithinForeach;

<<__EntryPoint>>
function main(): void {
  $vec_of_tuples = vec[
    tuple('A', 'B', 'C'),
    tuple('a', 'b', 'c'),
    tuple('X', 'Y', 'Z'),
  ];

  foreach ($vec_of_tuples as list($first, $second, $third)) {
    echo "{$first} {$second} {$third}\n";
  }
}
