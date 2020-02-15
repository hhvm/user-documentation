<?hh

namespace Hack\UserDocumentation\ErrorCodes\ArrayAppend;

function foo(mixed $m): void {
  /* HH_FIXME[4006] $m may not be an array. */
  $m[] = 1;
}
