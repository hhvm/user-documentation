The following example shows how to get the number of errors or warnings on the last SQL query via `AsyncMysqlConnection::warningCount`.

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
async function get_warning_count_on_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await $conn->query('SELECT name FROM test_table WHERE userID = 1');
  $wc = $conn->warningCount();
  $conn->close();
  return $wc;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $wc = await get_warning_count_on_query();
  \var_dump($wc);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(0)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
