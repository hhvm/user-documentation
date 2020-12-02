<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterOptionExceptionMethodGetErrors\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  // For many use cases, calling MCRouter::createSimple($servers) would
  // suffice here. But this shows you how to explicitly create the configuration
  // options for creating an instance of MCRouter

  // This has a bad option setup
  $options = darray['asynclog_disable' => 'purple'];

  $mc = null;

  try {
    $mc = new \MCRouter($options);
  } catch (\MCRouterOptionException $ex) {
    \var_dump($ex->getErrors());
  }
}
