The following example shows how to retrieve the memcached operation from an `MCRouterException` using its `getOp` method. Then we get its friendly name via `MCRouter::getOpName()`.

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
  try {
    // Shouldn't be able to add the same key twice
    await add_value($mc, $unique_key, "Bye");
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
    \var_dump($ex->getOp()); // will output an integer
    \var_dump(\MCRouter::getOpName($ex->getOp())); // will output friendlyt name
  }
}
```.hhvm.expectf
string(39) "add failed with result mc_res_notstored"
int(7)
string(3) "add"
```.example.hhvm.out
string(39) "add failed with result mc_res_notstored"
int(7)
string(3) "add"
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
