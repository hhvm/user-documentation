// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassMCRouterMethodCreateSimple\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  \var_dump($mc is \MCRouter);
}
