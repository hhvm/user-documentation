Every connection has a connection result. You get the connection result from a call to `AsyncMysqlConnection::connectResult`. And one of the methods on an `AsyncMysqlConnectResult` is `endTime()`, which tells you when the connection operation completed.

Note that 

```
  elapsedMicros() ~== endTime() - startTime()
```

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
async function get_connection_start_time(): Awaitable<?float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $et = $conn->connectResult()?->endTime();
  $conn->close();
  return $et;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $et = await get_connection_start_time();
  \var_dump($et);
}
```.hhvm.expectf
float(%f)
```.example.hhvm.out
float(17354.068556)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
