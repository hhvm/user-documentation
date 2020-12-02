This example shows how to get data about the async MySQL connection you made via a call to `AsyncMysqlConnection::connectResult`. An `AsyncMysqlConnectResult` is returned and there are various statistical methods you can call. Here, we call `elapsedTime` to show the time it took to make the connection.

Interestingly, if you run this example twice or more, you may notice that the second time on will show a lower elapsed time than the first. This could be due to caching mechanisms, etc.

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
async function get_connect_time(): Awaitable<?int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = $conn->connectResult(); // returns ?\AsyncMysqlConnectResult
  $conn->close();
  return $result?->elapsedMicros();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $time = await get_connect_time();
  \var_dump($time);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(2984)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
