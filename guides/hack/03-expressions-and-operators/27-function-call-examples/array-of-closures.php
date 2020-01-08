<?hh // strict

namespace Hack\UserDocumentation\ExpAndOps\FunctionCall\Examples\Closures;

use type HH\Lib\Ref;

<<__EntryPoint>>
function main(): void {
  $table = vec[
    (int $p) ==> $p * 2, // doubler
    (int $p) ==> $p * 3, // tripler
    (int $p) ==> $p * 4, // quadrupler
  ];

  $next = sequence();

  $v = $table[$next()]($next()); // eval is L-to-R
  echo "\$v = $v\n";

  $v = $table[$next()]($next()); // eval is L-to-R
  echo "\$v = $v\n";
}

/**
 * Returns a function which will return the next
 * number in a sequence, starting at 0, 1, 2, 3, etc.
 */
function sequence(): (function(): int) {
  $ticket = new Ref(-1);
  return () ==> {
    $ticket->value++;
    return $ticket->value;
  };
}
