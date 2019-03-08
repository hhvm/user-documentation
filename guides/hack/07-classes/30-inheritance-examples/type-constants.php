<?hh // strict

namespace Hack\UserDocumentation\Classes\Inheritance\Examples\TypeConstants;

abstract class CBase {
  abstract const type T;
  public function __construct(protected this::T $value) {}
}

class Cstring extends CBase {
  const type T = string;
  public function get_string(): string {
    return $this->value;	// gets the string
  }
}

class Cint extends CBase {
  const type T = int;
  public function get_int(): int {
    return $this->value;	// gets the int
  }
}

<<__EntryPoint>>
function run2(): void {
  \var_dump((new Cstring('abc'))->get_string());
  \var_dump((new Cint(123))->get_int());
}
