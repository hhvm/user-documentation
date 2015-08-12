<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\NoLoop;

class User {
  protected function __construct(string $name) {}

  static function get_name(int $id): User {
    return new User(str_shuffle("ABCDEFGHIJ") . strval($id));
  }
}

async function load_user(int $id): Awaitable<User> {
  // Load user from somewhere (e.g., database).
  // Fake it for now
  return User::get_name($id);
}

async function load_users_no_loop(array<int> $ids): Awaitable<Vector<User>> {
  return await \HH\Asio\vm($ids, fun('load_user'));
}

\HH\Asio\join(load_users_no_loop());
