<?hh

async function load_user(int $id): Awaitable<User> {
  // Load user from somewhere (e.g., database)
}

async function load_users_await_loop(array<int> $ids): Awaitable<Vector<User>> {
  $result = Vector {};
  foreach ($ids as $id) {
    $result[] = await load_user($id);
  }
  return $result;
}

HH\Asio\join(load_users_await_loop());
