<?hh

namespace Hack\UserDocumentation\Lambdas\Examples\Design\Introduction;

class User {
  public string $name;
  protected function __construct(string $name) { $this->name = $name; }
  public static function get(int $id): User {
    // Load user from database, return a stub for the example
    return new User("User" . \strval($id));
  }
}

function getUsersFromIds(Vector<int> $userids): Vector<User> {
  return $userids->map($id ==> User::get($id));
}

function run(): void {
  \var_dump(getUsersFromIds(Vector { 1, 2, 3, 4 }));
}

run();
