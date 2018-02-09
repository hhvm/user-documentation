<?hh

namespace Hack\UserDocumentation\Lambdas\Examples\Examples\SyntaxExamples;

function addLastname(): Vector<string> {
  $people = Vector {
      "Carlton",
      "Will",
      "Phil"
  };
  // You need parentheses when adding a type annotation or default value
  $annotatedArgument = (string $name) ==> $name . " Banks";
  $annotatedReturnType = ($name): string ==> $name . " Banks";
  $defaultValue = (string $name = "Ashley") ==> $name . " Banks";

  // You could use any of the above closures.
  return $people->map($annotatedReturnType);
}

function calculateYears(): int {
  // You need parentheses when using more than one argument
  $difference = ($start, $end) ==> $end - $start;
  return $difference(1990, 1996);
}

function familySize(): int {
  $people = Vector {
      "Carlton",
      "Will",
      "Phil"
  };
  // You can use curly braces to create a compound statement
  $calculateSize = $family ==> {
    $counter = 0;
    foreach ($family as $member) {
      $counter++;
    }
    return $counter;
  };
  return $calculateSize($people);
}

function run(): void {
  \var_dump(familySize());
  \var_dump(calculateYears());
  \var_dump(addLastname());
}

run();
