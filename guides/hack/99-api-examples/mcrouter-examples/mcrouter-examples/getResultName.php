<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\GetResultName;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector { getenv('HHVM_TEST_MCROUTER') };
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

function get_res_name(\MCRouter $mc, int $res_num): string {
    return $mc->GetResultName($res_num);
}

async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();

  // You can pass raw integers
  var_dump(get_res_name($mc, 3));
  var_dump(get_res_name($mc, 9));
  var_dump(get_res_name($mc, -1));
  var_dump(get_res_name($mc, 0));
  var_dump(get_res_name($mc, 100));

  // You can pass MCRouter constants
  var_dump(get_res_name($mc, \MCRouter::mc_res_timeout));
  var_dump(get_res_name($mc, \MCRouter::mc_res_bad_flags));
  var_dump(get_res_name($mc, \MCRouter::mc_res_local_error));

  // You can pass something from an exception too
  try {
    $val = await $mc->get('KEYDOESNOTEXISTIHOPEREALLY');
  } catch (\MCRouterException $ex) {
    var_dump($ex->getCode());
    var_dump(get_res_name($mc, $ex->getCode()));
  }
}

\HH\Asio\join(run());
