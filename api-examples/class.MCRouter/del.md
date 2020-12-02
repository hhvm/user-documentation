The following example uses `MCRouter::del` to delete a key from the memcached server. Once the key is deleted, it is no longer accessible. Nor can you delete a non-existing key.

```basic-usage.php
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

async function del_key(\MCRouter $mc, string $key): Awaitable<void> {
  // can also pass optional int flags and int expiration time (in seconds)
  await $mc->del($key);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "Hi");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  await del_key($mc, $unique_key);
  try {
    // Try getting the key after it has been deleted
    $val = await $mc->get($unique_key);
    \var_dump($val); // Not going to get here.
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage()); // We should get here because key was deleted
  }
}
```.hhvm.expectf
string(2) "Hi"
string(38) "get failed with result mc_res_notfound"
```.example.hhvm.out
string(2) "Hi"
string(38) "get failed with result mc_res_notfound"
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
