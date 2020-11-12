<?hh

namespace Hack\UserDocumentation\Types\Nothing\Examples\Undefined;

type undefined = nothing;

function undefined(): undefined {
  throw new \Error('NOT IMPLEMENTED: `undefined` can not be produced.');
}
