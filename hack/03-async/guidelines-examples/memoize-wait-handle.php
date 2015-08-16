<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\MemoizeWaitHandle;

async function time_consuming(): Awaitable<string> {
  sleep(5);
  return "Not really time consuming but sleep."; // For type-checking purposes
}

async function memoize_handle(): Awaitable<string> {
  static $handle = null;
  if ($handle === null) {
    $handle = time_consuming(); // memoize the wait handle
  }
  return await $handle;
}

\HH\Asio\join(memoize_handle());
