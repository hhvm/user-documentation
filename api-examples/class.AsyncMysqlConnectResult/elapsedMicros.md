Every connection has a connection result. You get the connection result from a call to `AsyncMysqlConnection::connectResult`. And one of the methods on an `AsyncMysqlConnectResult` is `elapsedMicros()`, which tells you how long it took to make the connection.

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
async function get_connection_time(): Awaitable<?int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $em = $conn->connectResult()?->elapsedMicros();
  $conn->close();
  return $em;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $em = await get_connection_time();
  \var_dump($em);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(3334)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
