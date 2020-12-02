The following example shows how to get the port of the MySQL server that this connection is associated with via `AsyncMysqlConnection::port`.

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
async function get_port(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $port = $conn->port();
  $conn->close();
  return $port;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $port = await get_port();
  \var_dump($port);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(3306)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
