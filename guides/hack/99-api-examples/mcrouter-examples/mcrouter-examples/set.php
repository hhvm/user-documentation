<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\Set;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector { getenv('HHVM_TEST_MCROUTER') };
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function set_value(\MCRouter $mc, string $key,
                         string $value): Awaitable<void> {
  await $mc->set($key, $value); // optional flags and expiration time
}

async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $unique_key = str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "Hi");
  $val = await $mc->get($unique_key);
  var_dump($val);
  try {
    // Setting the same key again is fine
    await set_value($mc, $unique_key, "Bye");
    $val = await $mc->get($unique_key);
    var_dump($val);
  } catch (\MCRouterException $ex) {
    var_dump($ex->getMessage()); // We should not get here
  }
}

\HH\Asio\join(run());
