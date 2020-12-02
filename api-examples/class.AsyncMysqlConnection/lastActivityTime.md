This example shows how to determine the last time a successful call was made using a given connection via `AsyncMysqlConnection::lastActivityTime`. The value returned is seconds since epoch as a `float`.

```basic-usage.php
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(
  \AsyncMysqlConnectionPool $pool,
): Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
}
async function get_time(): Awaitable<float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $t = $conn->lastActivityTime();
  $conn->close();
  return $t;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $t = await get_time();
  \var_dump($t);
}
```.hhvm.expectf
float(%f)
```.example.hhvm.out
float(17272.084797)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
