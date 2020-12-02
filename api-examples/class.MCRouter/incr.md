The following example shows how to increment a value of a key by a specified integer using `MCRouter::incr`. The value **must** be numeric.

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

async function inc_value(
  \MCRouter $mc,
  string $key,
  int $amount,
): Awaitable<void> {
  await $mc->incr($key, $amount);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $mc = get_simple_mcrouter();
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "1");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  await inc_value($mc, $unique_key, 3);
  $val = await $mc->get($unique_key);
  \var_dump($val);

  // Try on a value not numeric
  $unique_key = \str_shuffle('ABCDEFGHIJKLMN');
  await set_value($mc, $unique_key, "B");
  $val = await $mc->get($unique_key);
  \var_dump($val);
  try {
    await inc_value($mc, $unique_key, 3); // won't be "E" :)
    $val = await $mc->get($unique_key);
    \var_dump($val);
  } catch (\MCRouterException $ex) {
    \var_dump($ex->getMessage()); // can't increment on a string
    \var_dump($val);
  }
}
```.hhvm.expectf
string(1) "1"
string(1) "4"
string(1) "B"
string(39) "incr failed with result mc_res_notfound"
string(1) "B"
```.example.hhvm.out
string(1) "1"
string(1) "4"
string(1) "B"
string(39) "incr failed with result mc_res_notfound"
string(1) "B"
```.skipif
\Hack\UserDocumentation\API\Examples\MCRouter\skipif();
```
