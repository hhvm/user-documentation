<?hh

async function load_user(int $id): Awaitable<User> {
  // Load user from somewhere (e.g., database)
}

async function load_users_no_loop(array<int> $ids): Awaitable<Vector<User>> {
  return await HH\Asio\vm($ids, fun('load_user'));
}

HH\Asio\join(load_users_no_loop());
