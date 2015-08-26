<?hh // strict

namespace Hack\UserDocumentation\TypeChecker\Special\Examples\HHFixMe;

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
  /* HH_FIXME[4110] Will make 6 to "6" later */
  annotating(6);
}

function also_call_annotating(): void {
  /* HH_FIXME[4110] Will make true to "true" later */
  annotating(true);
}

/* HH_FIXME[1002] Will move this call to a partial file later */
call_annotating();
