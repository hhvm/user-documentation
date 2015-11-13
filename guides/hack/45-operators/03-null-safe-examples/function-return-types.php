<?hh

namespace Hack\UserDocumentation\Operators\NullSafe\Examples\FuncReturnTypes;

class Bar {
  public function baz(): int {
    return 5;
  }
}

function get_Bar(): ?Bar {
  if (rand(0, 10) < 5) {
    return null;
  }
  return new Bar();
}

function foo(): ?int {
  $b = get_Bar();
  return $b?->baz();
}

var_dump(foo());
