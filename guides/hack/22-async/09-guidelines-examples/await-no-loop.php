<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\NoLoop;

require __DIR__ . "/../../../../vendor/hh_autoload.php";

class User {
  public string $name;

  protected function __construct(string $name) { $this->name = $name; }

  static function get_name(int $id): User {
    return new User(\str_shuffle("ABCDEFGHIJ") . \strval($id));
  }
}

async function load_user(int $id): Awaitable<User> {
  // Load user from somewhere (e.g., database).
  // Fake it for now
  return User::get_name($id);
}

async function load_users_no_loop(array<int> $ids): Awaitable<Vector<User>> {
  return await \HH\Asio\vm(
    $ids,
    fun('\Hack\UserDocumentation\Async\Guidelines\Examples\NoLoop\load_user')
  );
}

function runMe(): void {
    $ids = array(1, 2, 5, 99, 332);
    $result = \HH\Asio\join(load_users_no_loop($ids));
    \var_dump($result[4]->name);
}

runMe();
