The following example describes how to get the average loop time of this SQL client's event handling (in this particular case, performing the connection) via `AsyncMysqlClientStats::ioEventLoopMicrosAvg`.

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
async function get_loop_info(): Awaitable<?float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $loop = $conn->connectResult()?->clientStats()?->ioEventLoopMicrosAvg();
  $conn->close();
  return $loop;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $l = await get_loop_info();
  \var_dump($l);
}
```.hhvm.expectf
float(%f)
```.example.hhvm.out
float(3.536136)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
