namespace Hack\UserDocumentation\Classes\Constructors\Examples\Duplication;

final class User {
  private int $id;
  private string $name;

  public function __construct(
    int $id,
    string $name,
  ) {
    $this->id = $id;
    $this->name = $name;
  }
}
