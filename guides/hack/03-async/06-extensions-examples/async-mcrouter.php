<?hh

namespace Hack\UserDocumentation\Async\Extensions\Examples\MCRouter;

function get_mcrouter_object(): \MCRouter {
  $servers = Vector {"192.168.0.110", "192.168.0.111"};
  return \MCRouter::createSimple($servers);
}

async function get_user_name(\MCRouter $mcr, int $user_id): Awaitable<string> {
  $key = 'name:' . $user_id;
  try {
    $res = await \HH\Asio\wrap($mcr->get($key));
    if ($res->isSucceeded()) {
      return $res->getResult();
    }
    return "";
  } catch (MCRouterException $ex) {
    echo $ex->getKey() . PHP_EOL . $ex->getOp();
    return "";
  }
}

\HH\Asio\join(get_user_name(get_mcrouter_object(), 22));
