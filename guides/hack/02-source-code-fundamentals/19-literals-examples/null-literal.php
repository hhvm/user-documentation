<?hh // strict

namespace Hack\UserDocumentation\Fundamentals\Literals\Examples\NullLiteral;

type IdSet = shape('id' => ?string, 'url' => ?string, 'count' => int);

function get_IdSet(): IdSet {
  return shape('id' => null, 'url' => null, 'count' => 0);
}
