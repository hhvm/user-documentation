<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\MemoizeResult;

async function time_consuming(): Awaitable<string> {
  \sleep(5);
  return "This really is not time consuming, but the sleep fakes it.";
}

async function memoize_result(): Awaitable<string> {
  static $result = null;
  if ($result === null) {
    $result = await time_consuming(); // don't memoize the resulting data
  }
  return $result;
}

function runMe(): void {
  $t1 = \microtime();
  \HH\Asio\join(memoize_result());
  $t2 = \microtime() - $t1;
  $t3 = \microtime();
  \HH\Asio\join(memoize_result());
  $t4 = \microtime() - $t3;
  \var_dump($t4 < $t2); // The memmoized result will get here a lot faster
}

runMe();
