<?hh

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\Decr;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector { \getenv('HHVM_TEST_MCROUTER') };
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function set_value(\MCRouter $mc, string $key,
                         string $value): Awaitable<void> {
  // can also pass optional int flags and int expiration time (in seconds)
  await $mc->set($key, $value);
}

async function dec_value(\MCRouter $mc, string $key, int $amount) {
  await $mc->decr($key, $amount);
}

async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "4");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  await dec_value($mc, $unique_key, 3);
  $val = await $mc->get($unique_key);
  \var_dump($val);

  // Try on a value not numeric
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "E");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  try {
    await dec_value($mc, $unique_key, 3); // won't be "B" :)
    $val = await $mc->get($unique_key);
    \var_dump($val);
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage()); // can't decrement on a string
    \var_dump($val);
  }
}

\HH\Asio\join(run());
