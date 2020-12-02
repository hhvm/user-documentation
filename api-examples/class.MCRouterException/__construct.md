You normally will catch a `MCRouterException` over constructing one explicitly, but it can be done. Here is an example where you can check the version of the memcached server and throw if you don't have the right one.

```basic-usage.php
async function simple_mcrouter(): Awaitable<void> {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  $ver = await $mc->version();
  if (\strpos($ver, "100.100") === false) {
    throw new \MCRouterException(
      "The version of memcached is not right",
      \MCRouter::mc_res_connect_error,
      \MCRouter::mc_op_servererr,
    );
  }
}


<<__EntryPoint>>
async function run(): Awaitable<void> {
  try {
    await simple_mcrouter();
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
    \var_dump($ex->getOp());
  }
}
```.hhvm.expect
string(37) "The version of memcached is not right"
int(14)
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
