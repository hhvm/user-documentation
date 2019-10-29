namespace Hack\UserDocumentation\Classes\Constructors\Examples\PromotionRules;

final class User {
  private static dict<int, User> $allUsers = dict[];
  private int $age;

  public function __construct(
    private int $id,
    private string $name,
    // Promoted parameters can be combined with regular non-promoted parameters.
    int $birthday_year,
  ) {
    $this->age = \date('Y') - $birthday_year;
    // The constructor parameter promotion assignments are done before the code
    // inside the constructor is run, so we can use $this->id here.
    self::$allUsers[$this->id] = $this;
  }
}
