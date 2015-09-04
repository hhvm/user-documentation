<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\Loop;

class User {
  public string $name;

  protected function __construct(string $name) { $this->name = $name; }

  static function get_name(int $id): User {
    return new User(str_shuffle("ABCDEFGHIJ") . strval($id));
  }
}

async function load_user(int $id): Awaitable<User> {
  // Load user from somewhere (e.g., database).
  // Fake it for now
  return User::get_name($id);
}

async function load_users_await_loop(array<int> $ids): Awaitable<Vector<User>> {
  $result = Vector {};
  foreach ($ids as $id) {
    $result[] = await load_user($id);
  }
  return $result;
}

function runMe(): void {
  $ids = array(1, 2, 5, 99, 332);
  $result = \HH\Asio\join(load_users_await_loop($ids));
  var_dump($result[4]->name);
}

runMe();
