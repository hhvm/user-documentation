namespace Hack\UserDocumentation\Classes\Constructors\Examples\Unpromotion;

use namespace HH\Lib\{C, Str, Vec};

// @example-start

final class User {
  private ParsedName $name;

  public function __construct(
    private int $id,
    string $name,
  ) {
    $this->name = parse_name($name);
  }
}

// @example-end
// the rest is not relevant for a guide about constructor parameter promotion

final class ParsedName {}

function parse_name(string $name): ParsedName {
  return new ParsedName();
}
