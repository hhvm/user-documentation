<?hh

namespace Hack\UserDocumentation\Lambdas\Examples\Examples\Difference;

function addLastnameTraditional(): array<string> {
  $people = array(
    "Carlton",
    "Will",
    "Phil"
  );
  return array_map(function ($name) {
    return $name . " Banks";
  }, $people);
}
