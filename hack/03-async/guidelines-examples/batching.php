<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\Batching;

// For asio-utilities function later(), etc.
require __DIR__ . "/../../../vendor/autoload.php";

async function b_one(string $key): Awaitable<string> {
  $subkey = await Batcher::lookup($key);
  return await Batcher::lookup($subkey);
}

async function b_two(string $key): Awaitable<string> {
  return await Batcher::lookup($key);
}

async function batching(): Awaitable<void> {
  $results = await \HH\Asio\v(array(b_one('hello'), b_two('world')));
  echo $results[0] . PHP_EOL;
  echo $results[1];
}

\HH\Asio\join(batching());

class Batcher {
  private static array<string> $pendingKeys = array();
  private static ?Awaitable<array<string, string>> $waitHandle = null;

  public static async function lookup(string $key): Awaitable<string> {
    // Add this key to the pending batch
    self::$pendingKeys[] = $key;
    // If there's no wait handle about to start, create a new one
    if (self::$waitHandle === null) {
      self::$waitHandle = self::go();
    }
    // Wait for the batch to complete, and get our result from it
    $results = await self::$waitHandle;
    return $results[$key];
  }

  private static async function go(): Awaitable<array<string, string>> {
    // Let other wait handles get into this batch
    await \HH\Asio\later();
    // Now this batch has started; clear the shared state
    $keys = self::$pendingKeys;
    self::$pendingKeys = array();
    self::$waitHandle = null;
    // Do the multi-key roundtrip
    return await multi_key_lookup($keys);
  }
}

async function multi_key_lookup(array<string> $keys)
  : Awaitable<array<string, string>> {

  // lookup multiple keys, but, for now, return something random
  $r = array();
  foreach ($keys as $key) {
    $r[$key] = str_shuffle("ABCDEF");
  }
  return $r;
}
