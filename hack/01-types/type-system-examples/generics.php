<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\Generics;

// This is a generic class that is parameterized by T. T can be bound to any
// type, but once it is bound to that type, it must stay that type. It
// can be bound to mixed.
class Box<T> {

  private array<T> $contents;

  public function __construct() {
    $this->contents = array();
  }

  public function put(T $x): void {
    $this->contents[] = $x;
  }

  public function get(): array<T> {
    return $this->contents;
  }
}

// This is a generic function. You parameterize it by putting the type
// parameters after the function name
function gift<T>(Box<T> $box, T $item): void {
  $box->put($item);
}

function ts_generics_1(): array<string> {
  $box = new Box();
  gift($box, "Hello");
  gift($box, "Goodbye");
  // can't do this because the typechecker knows by our return statement and
  // our return type that we are binding the Box to a string type. If we did
  // something like ": array<arraykey>", then it would work.
  // gift($box, 3);
  return $box->get();
}

function ts_generics_2(): array<arraykey> {
  $box = new Box();
  gift($box, "Hello");
  gift($box, "Goodbye");
  gift($box, 3);
  return $box->get();
}

var_dump(ts_generics_1());
var_dump(ts_generics_2());
