<?hh // strict

namespace Hack\UserDocumentation\TypeChecker\Special\Examples\Unsafe;

// This was the function before we went to strict mode and added annotations to
// to the annotating function. It was fine from the typechecker perspective.
/*

function annotating($x) {
  return $x > 5 ? "Hello" : $x;
}

*/

function annotating(?string $x): string {
  return $x === null ? "Hello" : "Bye";
}

function call_annotating(): void {
  // UNSAFE
  annotating(6);
}

function also_call_annotating(): void {
  // UNSAFE
  annotating(true);
}

/* HH_FIXME[1002] Will move this call to a partial file later */
call_annotating();
