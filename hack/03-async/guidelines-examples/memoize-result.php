<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\MemoizeResult;

async function time_consuming(): Awaitable<string> {
  sleep(5);
  return "This really is not time consuming, but the sleep fakes it.";
}

async function memoize_result(): Awaitable<string> {
  static $result = null;
  if ($result === null) {
    $result = await time_consuming(); // don't memoize the resulting data
  }
  return $result;
}

\HH\Asio\join(memoize_result());
