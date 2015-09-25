<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\GetOpName;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector { getenv('HHVM_TEST_MCROUTER') };
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

function get_op_name(\MCRouter $mc, int $op_num): string {
    return $mc->GetOpName($op_num);
}

async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();

  // You can pass raw integers
  var_dump(get_op_name($mc, 3));
  var_dump(get_op_name($mc, 9));
  var_dump(get_op_name($mc, -1));
  var_dump(get_op_name($mc, 0));
  var_dump(get_op_name($mc, 100));

  // You can pass something from an exception too
  try {
    $val = await $mc->get('KEYDOESNOTEXISTIHOPEREALLY');
  } catch (\MCRouterException $ex) {
    var_dump($ex->getOp());
    var_dump(get_op_name($mc, $ex->getOp()));
  }
}

\HH\Asio\join(run());
