The following example shows how to use `MCRouter::flushAll` to basically flush out the memcached server of all keys and values. 

It is **imperative** to note that you must manually construct the `MCRouter` instance passing `'enable_flush_cmd' => true` as one of your options; otherwise a command disabled exception will be thrown. In other words, you cannot use `MCRouter::createSimple()` when using `flushAll`.

You can add an optional delay time in seconds to your call to `flushAll` as well.

```basic-usage.php
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
```.hhvm.expectf
bool(true)
string(2) "Hi"
string(38) "get failed with result mc_res_notfound"
```.example.hhvm.out
bool(true)
string(2) "Hi"
string(38) "get failed with result mc_res_notfound"
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
