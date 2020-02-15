<?hh

namespace Hack\UserDocumentation\ErrorCodes\FieldName;

function foo(shape(...) $s): void {
  /* HH_FIXME[4051] Invalid shape field name. */
  $value = $s[1.0];
}
