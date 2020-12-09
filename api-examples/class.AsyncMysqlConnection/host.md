The following example shows how to get the host of the MySQL server that this connection is associated with via `AsyncMysqlConnection::host`.

```basic-usage.hack
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
async function get_host(): Awaitable<string> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $info = $conn->host();
  $conn->close();
  return $info;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $info = await get_host();
  \var_dump($info);
}
```.hhvm.expectf
string(%d) "%s"
```.example.hhvm.out
string(9) "localhost"
```.skipif
await \Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
```
