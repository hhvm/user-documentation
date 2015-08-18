<?hh // strict
namespace Hack\UserDocumentation\Lambdas\Examples\Examples\Introduction;

function addLastname(): array<string> {
  $people = array(
      "Carlton",
      "Will",
      "Phil"
  );
  return array_map($name ==> $name . " Banks", $people);
}
