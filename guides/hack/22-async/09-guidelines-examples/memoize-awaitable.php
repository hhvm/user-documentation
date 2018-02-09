<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\MemoizeAwaitable;

async function time_consuming(): Awaitable<string> {
  \sleep(5);
  return "Not really time consuming but sleep."; // For type-checking purposes
}

function memoize_handle(): Awaitable<string> {
  static $handle = null;
  if ($handle === null) {
    $handle = time_consuming(); // memoize the awaitable
  }
  return $handle;
}

function runMe(): void {
  $t1 = \microtime(true);
  \HH\Asio\join(memoize_handle());
  $t2 = \microtime(true) - $t1;
  $t3 = \microtime(true);
  \HH\Asio\join(memoize_handle());
  $t4 = \microtime(true) - $t3;
  \var_dump($t4 < $t2); // The memmoized result will get here a lot faster
}

runMe();
