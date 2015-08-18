<?hh // strict
namespace Hack\UserDocumentation\Lambdas\Examples\Examples\CaptureVariables;

function addLastname(string $lastname): array<string> {
  $people = array(
      "Carlton",
      "Will",
      "Phil"
  );
  return array_map($name ==> $name . " " . $lastname, $people);
}

function addLastnameTraditional(string $lastname): array<string> {
  $people = array(
      "Carlton",
      "Will",
      "Phil"
  );
  return array_map(function ($name) use ($lastname) {
    return $name . " " . $lastname;
  }, $people);
}
