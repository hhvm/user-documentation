<?hh

namespace Hack\UserDocumentation\ErrorCodes\UnboundVar;

function foo(): mixed {
  /* HH_FIXME[2050] This variable doesn't exist. */
  return $no_such_var;
}
