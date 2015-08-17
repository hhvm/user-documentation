<?hh

namespace Hack\UserDocumentation\Operators\NullSafe\Examples\AccessingProps;

class Bar {
  // This uses constructor parameter promotion
  public function __construct(public string $str = "") {}
}

function get_Bar(): ?Bar {
  if (rand(0, 10) < 5) {
    return null;
  }
  return new Bar("Hello");
}

function foo(): ?string {
  $b = get_Bar();
  // Use the null-safe operator to access a proprety of a class.
  return $b?->str;
}


var_dump(foo());
