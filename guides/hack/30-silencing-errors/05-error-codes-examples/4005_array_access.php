<?hh

namespace Hack\UserDocumentation\ErrorCodes\ArrayAccess;

function foo(int $m): void {
  /* HH_FIXME[4005] Indexing a type that isn't indexable. */
  $value = $m['foo'];
}
