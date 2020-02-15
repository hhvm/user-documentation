<?hh

namespace Hack\UserDocumentation\ErrorCodes\ShapeMissingField;

function foo(): shape('x' => int) {
  /* HH_FIXME[4057] Missing the field `x`. */
  return shape();
}
