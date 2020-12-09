<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassMCRouterMethodFlushAll\BasicUsage;

function construct_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  // For many use cases, calling MCRouter::createSimple($servers) would
  // suffice here. But this shows you how to explicitly create the configuration
  // options for creating an instance of MCRouter
  $options = darray[
    'config_str' => \json_encode(
      darray[
        'pools' => darray[
          'P' => darray[
            'servers' => $servers,
          ],
        ],
        'route' => 'PoolRoute|P',
      ],
    ),
    'enable_flush_cmd' => true, // Need this in order to use flushAll
  ];
  $mc = new \MCRouter($options); // could also pass a persistence id string here
  \var_dump($mc is \MCRouter);
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

async function del_key(\MCRouter $mc, string $key): Awaitable<void> {
  // can also pass optional int flags and int expiration time (in seconds)
  await $mc->del($key);
}

async function flush(\MCRouter $mc): Awaitable<void> {
  await $mc->flushAll(); // can add an optional delay time in seconds
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $mc = construct_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "Hi");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  await del_key($mc, $unique_key);
  await flush($mc);
  try {
    $val = await $mc->get($unique_key);
    \var_dump($val); // Won't get here because exception will be thrown
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage()); // There are no more keys/values since flush
  }
}
