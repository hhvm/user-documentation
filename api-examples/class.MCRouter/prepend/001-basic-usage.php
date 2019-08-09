<?hh // partial

namespace Hack\UserDocumentation\API\Examples\MCRouter\MCrouter\Prepend;

function get_simple_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function set_value(
  \MCRouter $mc,
  string $key,
  string $value,
): Awaitable<void> {
  // can also pass optional int flags and int expiration time (in seconds)
  await $mc->set($key, $value);
}

async function prepend_to_value(
  \MCRouter $mc,
  string $key,
  string $prepend_str,
): Awaitable<void> {
  await $mc->prepend($key, $prepend_str);
}

async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, 'Hi');
  $val = await $mc->get($unique_key);
  \var_dump($val);
  try {
    await prepend_to_value($mc, $unique_key, 'Oh');
    $val = await $mc->get($unique_key);
    \var_dump($val);
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
  }
}

\HH\Asio\join(run());
