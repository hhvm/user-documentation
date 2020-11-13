<?hh

namespace Hack\UserDocumentation\AsyncOps\Guidelines\Examples\MemoizeAwaitable;

abstract final class MemoizeAwaitable {
  private static async function time_consuming(): Awaitable<string> {
    await \HH\Asio\usleep(5000000);
    return "Not really time consuming but sleep."; // For type-checking purposes
  }

  private static ?Awaitable<string> $handle = null;

  public static function memoize_handle(): Awaitable<string> {
    if (self::$handle === null) {
      self::$handle = self::time_consuming(); // memoize the awaitable
    }
    return self::$handle;
  }
}

<<__EntryPoint>>
function runMe(): void {
  $t1 = \microtime(true);
  \HH\Asio\join(MemoizeAwaitable::memoize_handle());
  $t2 = \microtime(true) - $t1;
  $t3 = \microtime(true);
  \HH\Asio\join(MemoizeAwaitable::memoize_handle());
  $t4 = \microtime(true) - $t3;
  \var_dump($t4 < $t2); // The memoized result will get here a lot faster
}
