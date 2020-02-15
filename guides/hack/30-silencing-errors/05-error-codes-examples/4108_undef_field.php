<?hh

namespace Hack\UserDocumentation\ErrorCodes\UndefinedShapeField;

function foo(shape('x' => int) $s): void {
  /* HH_FIXME[4108] No such field in this shape. */
  $value = $s['not_x'];
}
