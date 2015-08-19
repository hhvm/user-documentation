<?hh // strict
namespace Hack\UserDocumentation\Lambdas\Examples\Examples\CaptureVariables;

function addLastname(string $lastname): Vector<string> {
  $people = Vector {
      "Carlton",
      "Will",
      "Phil"
  };
  return $people->map($name ==> $name . " " . $lastname);
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
