The following example describes how to get the average delay time between when a callback is scheduled (in this case, performing the connection) and when the callback actual ran (in this case, when the connection was actually established) via `AsyncMysqlClientStats::callbackDelayMicrosAvg`.

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
async function get_delay(): Awaitable<?float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $delay = $conn->connectResult()?->clientStats()?->callbackDelayMicrosAvg();
  $conn->close();
  return $delay;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $d = await get_delay();
  \var_dump($d);
}
```.hhvm.expectf
float(%f)
```.example.hhvm.out
float(44.25)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
