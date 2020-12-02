The following example allows you to use `MCRouter::version` to get the version information of the memcached server you are connected to.

```basic-usage.php
function get_simple_mcrouter(): \MCRouter {
  $servers = Vector {\getenv('HHVM_TEST_MCROUTER')};
  $mc = \MCRouter::createSimple($servers);
  return $mc;
}

async function get_version(\MCRouter $mc): Awaitable<?string> {
  $ret = null;
  try {
    $ret = await $mc->version();
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage());
  }
  return $ret;

}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $ver = await get_version($mc);
  \var_dump($ver);
}
```.hhvm.expectf
string(%d) "%s"
```.example.hhvm.out
string(5) "1.4.4"
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
