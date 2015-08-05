<?hh

async function time_consuming(): Awaitable<string> {
  // ...
}

async memoize_result(): Awaitable<string> {
  static $result = null;
  if ($result === null) {
    $result = await time_consuming(); // don't memoize the resulting data
  }
  return $result
}

HH\Asio\join(memoize_result());
