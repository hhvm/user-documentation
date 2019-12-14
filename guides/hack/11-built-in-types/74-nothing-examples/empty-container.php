<?hh // strict

namespace Hack\UserDocumentation\Types\Nothing\Examples\EmptyContainer;

<<__EntryPoint>>
function main(): noreturn {
  // The type of $people_in_my_car is `vec<nothing>`.
  $people_in_my_car = vec[];
  foreach ($people_in_my_car as $person) {
    // Again the type of $person is `nothing`.
    // There is noone in my car, so we'll never get a runtime error here.
    $person->getOutOfMyCar();
  }

  echo "We got here, safe and sound.\n";

  // When you stepped in my car, the type of
  // $people_in_my_car became `vec<Person>`.
  $people_in_my_car[] = new Person('You');
  foreach ($people_in_my_car as $person) {
    // The type of $person is now Person.
    // ERROR: Typing[4053] No method 'getOutOfMyCar' in Person
    $person->getOutOfMyCar();
  }

  echo "However, we'll never get here.\n";

  exit();
}

class Person {
  public function __construct(public string $name) {}
  // No methods
}
