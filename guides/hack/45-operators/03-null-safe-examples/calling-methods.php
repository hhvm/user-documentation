<?hh

namespace Hack\UserDocumentation\Operators\NullSafe\Examples\CallingMethods;

class Bar {
  public function baz(): int {
    return 5;
  }
}

function get_Bar(): ?Bar {
  if (rand(0, 10) === 5) {
    return null;
  }
  return new Bar();
}

function foo(): ?int {
  $b = get_Bar();
  // Use the null-safe operator to access a method of class.
  return $b?->baz();
}


var_dump(foo());
