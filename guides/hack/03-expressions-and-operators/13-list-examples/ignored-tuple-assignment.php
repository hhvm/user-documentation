<?hh

namespace Hack\UserDocumentation\ExprAndOps\List\IgnoredTupleAssignment;

<<__EntryPoint>>
function main(): void {
  $tuple = tuple('a', 'b', 'c', 1, 2, 3);
  list($_, $b, $c, $_, $two, $_) = $tuple;
  echo "b -> {$b}, c -> {$c}, two -> {$two}\n";
}
