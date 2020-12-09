// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Guidelines\Batching;

use namespace HH\Lib\Vec;

async function b_one(string $key): Awaitable<string> {
  $subkey = await Batcher::lookup($key);
  return await Batcher::lookup($subkey);
}

async function b_two(string $key): Awaitable<string> {
  return await Batcher::lookup($key);
}

async function batching(): Awaitable<void> {
  $results = await Vec\from_async(vec[b_one('hello'), b_two('world')]);
  \printf("%s\n%s\n", $results[0], $results[1]);
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  \HH\Asio\join(batching());
}

class Batcher {
  private static vec<string> $pendingKeys = vec[];
  private static ?Awaitable<dict<string, string>> $aw = null;

  public static async function lookup(string $key): Awaitable<string> {
    // Add this key to the pending batch
    self::$pendingKeys[] = $key;
    // If there's no awaitable about to start, create a new one
    if (self::$aw === null) {
      self::$aw = self::go();
    }
    // Wait for the batch to complete, and get our result from it
    $results = await self::$aw;
    return $results[$key];
  }

  private static async function go(): Awaitable<dict<string, string>> {
    // Let other awaitables get into this batch
    await \HH\Asio\later();
    // Now this batch has started; clear the shared state
    $keys = self::$pendingKeys;
    self::$pendingKeys = vec[];
    self::$aw = null;
    // Do the multi-key roundtrip
    return await multi_key_lookup($keys);
  }
}

async function multi_key_lookup(
  vec<string> $keys,
): Awaitable<dict<string, string>> {

  // lookup multiple keys, but, for now, return something random
  $r = dict[];
  foreach ($keys as $key) {
    $r[$key] = \str_shuffle("ABCDEF");
  }
  return $r;
}
