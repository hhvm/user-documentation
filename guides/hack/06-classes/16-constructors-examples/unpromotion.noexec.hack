namespace HHVM\UserDocumentation\Guides\Hack\Classes\Constructors\Unpromotion;

use namespace HH\Lib\{C, Str, Vec};

final class User {
  private ParsedName $name;

  public function __construct(
    private int $id,
    string $name,
  ) {
    $this->name = parse_name($name);
  }
}
