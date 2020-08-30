<?hh

namespace Hack\UserDocumentation\Types\Noreturn\Examples\Refinement;

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  $nullable_int = '' ? 0 : null;
  if (!($nullable_int is nonnull)) {
    invariant_violation('$arraykey must not be a string');
  }
  // If we didn't fall into the if above, $nullable_int must be an int.
  takes_int($nullable_int);
}

function takes_int(int $int): void {
  echo $int;
}
