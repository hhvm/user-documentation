<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\Version;

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

async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $ver = await get_version($mc);
  \var_dump($ver);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \HH\Asio\join(run());
}
