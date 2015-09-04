<?hh

namespace Hack\UserDocumentation\Lambdas\Examples\Design\Annotation;

function getLambda(): (function(?int): bool) {
  return $x ==> $x === null || $x === 0;
}

var_dump(getLambda());
