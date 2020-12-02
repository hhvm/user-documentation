<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterMethodIncr\BasicUsage;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function set_value(
  \MCRouter $mc,
  string $key,
  string $value,
): Awaitable<void> {
  // can also pass optional int flags and int expiration time (in seconds)
  await $mc->set($key, $value);
}

async function inc_value(
  \MCRouter $mc,
  string $key,
  int $amount,
): Awaitable<void> {
  await $mc->incr($key, $amount);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $mc = get_simple_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "1");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  await inc_value($mc, $unique_key, 3);
  $val = await $mc->get($unique_key);
  \var_dump($val);

  // Try on a value not numeric
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "B");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  try {
    await inc_value($mc, $unique_key, 3); // won't be "E" :)
    $val = await $mc->get($unique_key);
    \var_dump($val);
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage()); // can't increment on a string
    \var_dump($val);
  }
}
