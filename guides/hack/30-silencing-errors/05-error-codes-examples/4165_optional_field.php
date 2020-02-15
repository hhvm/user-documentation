<?hh

namespace Hack\UserDocumentation\ErrorCodes\OptionalShapeField;

function foo(shape(?'x' => int) $s): void {
  /* HH_FIXME[4165] This field may not be present. */
  $value = $s['x'];
}
