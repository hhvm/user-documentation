<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterMethodVersion\BasicUsage;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function get_version(\MCRouter $mc): Awaitable<?string> {
  $ret = null;
  try {
    $ret = await $mc->version();
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
  }
  return $ret;

}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $mc = get_simple_mcrouter();
  $ver = await get_version($mc);
  \var_dump($ver);
}
