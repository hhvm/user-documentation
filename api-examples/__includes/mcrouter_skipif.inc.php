<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter;

function skipif(): void {
  if (!\extension_loaded('mcrouter') || !\extension_loaded('memcached')) {
    echo 'skip';
    return;
  }

  // e.g., export HHVM_TEST_MCROUTER=127.0.0.1:11211
  if (!\getenv('HHVM_TEST_MCROUTER')) {
    echo 'skip';
    return;
  }

  $memc = new \Memcached();
  $memc->addServer('localhost', 11211);
  $version = $memc->getVersion();
  if (!$version) {
    echo "SKIP No Memcached running";
    return;
  }

  try {
    $servers = Vector { \getenv('HHVM_TEST_MCROUTER') };
    $mc = \MCRouter::createSimple($servers);
  } catch (\Exception $ex) {
    echo 'skip';
  }
}
