<?hh // strict
namespace Hack\UserDocumentation\Lambdas\Examples\Examples\Introduction;

function addLastname(): Vector<string> {
  $people = Vector {
      "Carlton",
      "Will",
      "Phil"
  };
  return $people->map($name ==> $name . " Banks");
}
