<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouterOptEx\GetErrors;

function construct_mcrouter(): void {
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

function run(): void {
  construct_mcrouter();
}

<<__EntryPoint>>
function basic_usage_main(): void {
  run();
}
