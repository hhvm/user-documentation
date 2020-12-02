Every connection has a connection result. You get the connection result from a call to `AsyncMysqlConnection::connectResult`. And one of the methods on an `AsyncMysqlConnectResult` is `clientStats()`, which gives you some information about the client you are connecting too.

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
async function get_client_stats(): Awaitable<?\AsyncMysqlClientStats> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $cstats = $conn->connectResult()?->clientStats();
  \var_dump($cstats?->callbackDelayMicrosAvg());
  $conn->close();
  return $cstats;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $cs = await get_client_stats();
  \var_dump($cs);
}
```.hhvm.expectf
float(%f)
object(AsyncMysqlClientStats) (0) {
}
```.example.hhvm.out
float(20.75)
object(AsyncMysqlClientStats) (0) {
}
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
