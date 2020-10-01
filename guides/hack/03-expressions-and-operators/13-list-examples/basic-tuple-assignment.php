<?hh

namespace Hack\UserDocumentation\ExprAndOps\List\BasicTupleAssignment;

<<__EntryPoint>>
function main(): void {
  $tuple = tuple('one', 'two', 'three');
  list($one, $two, $three) = $tuple;
  echo "1 -> {$one}, 2 -> {$two}, 3 -> {$three}\n";
}
