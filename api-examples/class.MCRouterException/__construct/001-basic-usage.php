<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouterEx\Construct;

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


async function run(): Awaitable<void> {
  try {
    await simple_mcrouter();
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
    \var_dump($ex->getOp());
  }
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \HH\Asio\join(run());
}
