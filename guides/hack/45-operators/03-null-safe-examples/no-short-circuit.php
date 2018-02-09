<?hh

namespace Hack\UserDocumentation\Operators\NullSafe\Examples\NoShortCircuit;

class Bar {
  public function baz(int $x): int {
    return $x + 5;
  }
}

function get_Bar(): ?Bar {
  if (\rand(0, 10) < 5) {
    return null;
  }
  return new Bar();
}

function foo(): ?int {
  $x = 4;
  $b = get_Bar();
  // Even if $b ends up being null, $x will be incremented to 5
  $y = $b?->baz($x++);
  \var_dump($x);
  return $y;
}

var_dump(foo());
