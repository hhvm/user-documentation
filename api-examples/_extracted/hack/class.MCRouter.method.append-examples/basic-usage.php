<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterMethodAppend\BasicUsage;

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

async function append_to_value(
  \MCRouter $mc,
  string $key,
  string $append_str,
): Awaitable<void> {
  await $mc->append($key, $append_str);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $mc = get_simple_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, 'Hi');
  $val = await $mc->get($unique_key);
  \var_dump($val);
  try {
    await append_to_value($mc, $unique_key, 'Oh');
    $val = await $mc->get($unique_key);
    \var_dump($val);
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
  }
}
