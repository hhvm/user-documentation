The following example shows how to use `MCRouter::add` to add a unique key/value pair to the memcached server. You cannot `add` the same key twice; if you need to update a key, use `MCRouter::set`

If you pass an expiration time for the key, that is in seconds.

And these are the bitwise or style flags that can be passed to `add`:

```
MC_MSG_FLAG_PHP_SERIALIZED = 0x1,
MC_MSG_FLAG_COMPRESSED = 0x2,
MC_MSG_FLAG_FB_SERIALIZED = 0x4,
MC_MSG_FLAG_FB_COMPACT_SERIALIZED = 0x8,
MC_MSG_FLAG_ASCII_INT_SERIALIZED = 0x10,
MC_MSG_FLAG_NZLIB_COMPRESSED = 0x800,
MC_MSG_FLAG_QUICKLZ_COMPRESSED = 0x2000,
MC_MSG_FLAG_SNAPPY_COMPRESSED = 0x4000,
MC_MSG_FLAG_BIG_VALUE = 0X8000,
MC_MSG_FLAG_NEGATIVE_CACHE = 0x10000,
MC_MSG_FLAG_HOT_KEY = 0x20000,
```

See the [header file with the flags](https://github.com/facebook/mcrouter/blob/5f259ed47b52f86cad750d2343edf324e80cb397/mcrouter/lib/mc/msg.h)

```basic-usage.php
function get_simple_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function add_value(
  \MCRouter $mc,
  string $key,
  string $value,
): Awaitable<void> {
  // can also pass optional int flags and int expiration time (in seconds)
  await $mc->add($key, $value);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await add_value($mc, $unique_key, "Hi");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  try {
    // Shouldn't be able to add the same key twice
    await add_value($mc, $unique_key, "Bye");
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
  }
}
```.hhvm.expectf
string(2) "Hi"
string(39) "add failed with result mc_res_notstored"
```.example.hhvm.out
string(2) "Hi"
string(39) "add failed with result mc_res_notstored"
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
