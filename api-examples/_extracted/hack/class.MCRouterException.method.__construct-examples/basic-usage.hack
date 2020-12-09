<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterExceptionMethodConstruct\BasicUsage;

async function simple_mcrouter(): Awaitable<void> {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  $ver = await $mc->version();
  if (\strpos($ver, "100.100") === false) {
    throw new \MCRouterException(
      "The version of memcached is not right",
      \MCRouter::mc_res_connect_error,
      \MCRouter::mc_op_servererr,
    );
  }
}


<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  try {
    await simple_mcrouter();
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
    \var_dump($ex->getOp());
  }
}
