<?hh

namespace Hack\UserDocumentation\OtherFeatures\CPP\Examples\Duplication;

class Users {
  public static array<User> $users = array();
}

class User {
  private int $id;
  private string $name;
  private bool $preferred;

  public function __construct(int $id, string $name, bool $preferred) {
    $this->id = $id;
    $this->name = $name;
    $this->preferred = $preferred;

    // Put user at the beginning of the database if preferred.
    if ($this->preferred) {
      array_unshift(&Users::$users, $this);
    } else {
      Users::$users[] = $this;
    }
  }
}

function run(): void {
  $u1 = new User(1, 'Joel', false);
  $u2 = new User(2, 'Fred', true);
  $u3 = new User(3, "Sam", false);
  $u4 = new User(4, 'Matthew', true);
  var_dump(Users::$users);
}

run();
