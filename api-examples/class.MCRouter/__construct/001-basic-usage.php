<?hh // partial

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\Construct;

function construct_mcrouter(): void {
  $servers = Vector { \getenv('HHVM_TEST_MCROUTER') };
  // For many use cases, calling MCRouter::createSimple($servers) would
  // suffice here. But this shows you how to explicitly create the configuration
  // options for creating an instance of MCRouter
  $options = array(
    'config_str' => \json_encode(
      array(
        'pools' => array(
          'P' => array(
            'servers' => $servers,
          ),
        ),
        'route' => 'PoolRoute|P',
      ),
    ),
  );
  $mc = new \MCRouter($options); // could also pass a persistence id string here
  \var_dump($mc is \MCRouter);
}

construct_mcrouter();
