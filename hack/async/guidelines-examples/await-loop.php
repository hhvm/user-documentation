<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\Loop;

class User {
  static function get_name(int $id) {
    return str_shuffle("ABCDEFGHIJ") . strval($id);
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

\HH\Asio\join(load_users_await_loop());
