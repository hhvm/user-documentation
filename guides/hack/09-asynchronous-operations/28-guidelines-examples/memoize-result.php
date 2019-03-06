<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Guidelines\Examples\MemoizeResult;

abstract final class MemoizeResult {
  private static async function time_consuming(): Awaitable<string> {
    \sleep(5);
    return "This really is not time consuming, but the sleep fakes it.";
  }

  private static ?string $result = null;

  public static async function memoize_result(): Awaitable<string> {
    if (self::$result === null) {
      self::$result = await self::time_consuming(); // don't memoize the resulting data
    }
    return self::$result;
  }
}
<<__EntryPoint>>
function runMe(): void {
  $t1 = \microtime(true);
  \HH\Asio\join(MemoizeResult::memoize_result());
  $t2 = \microtime(true) - $t1;
  $t3 = \microtime(true);
  \HH\Asio\join(MemoizeResult::memoize_result());
  $t4 = \microtime(true) - $t3;
  \var_dump($t4 < $t2); // The memmoized result will get here a lot faster
}
