<?hh

namespace Hack\UserDocumentation\ErrorCodes\NullContainerAccess;


function foo(?vec<int> $items): void {
  /* HH_FIXME[4063] $items can be null. */
  $x = $items[0];
}
