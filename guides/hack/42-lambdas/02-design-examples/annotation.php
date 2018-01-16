<?hh

namespace Hack\UserDocumentation\Lambdas\Examples\Design\Annotation;

function getLambda(): (function(?int): bool) {
  return $x ==> $x === null || $x === 0;
}

function annotateLambda(string $s1, string $s2): array<string> {
  $strs = array($s1, $s2);
  usort(
    &$strs,
    (string $s1, string $s2): int ==> strlen($s1) - strlen($s2)
  );
  return $strs;
}
function run(): void {
  var_dump(getLambda());
  var_dump(annotateLambda('Joel', 'Tim'));
}

run();
