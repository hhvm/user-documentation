<?hh // strict

namespace Hack\UserDocumentation\ExprAndOps\List\TypedTupleAssignment;

<<__EntryPoint>>
function main(): void {
  $tuple = tuple('string', 1, false);
  list($string, $int, $bool) = $tuple;
  takes_string($string);
  takes_int($int);
  takes_bool($bool);
  echo 'The typechecker understands the types of list().';
}

function takes_string(string $_): void {}
function takes_int(int $_): void {}
function takes_bool(bool $_): void {}
