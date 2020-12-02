If you ever want to get a plain, vanilla synchronous MySQL connection from your async connection, you call `AsyncMysqlConnection::releaseConnection`. This examples show how to get such a connection, noting too that your async connection is destroyed.

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
async function simple_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await $conn->query('SELECT name FROM test_table WHERE userID = 1');
  $sync_connection = $conn->releaseConnection();
  \var_dump($sync_connection);
  try {
    $result2 = await $conn->query(
      'SELECT name FROM test_table WHERE userID = 1',
    );
  } catch (\Exception $ex) { // probably InvalidArgumentException on query
    echo "Connection destroyed when released\n";
  }
  // This call will block since it is not async
  $sync_result = \mysql_query(
    'SELECT name FROM test_table WHERE userID = 1',
    $sync_connection,
  );
  $sync_rows = \mysql_num_rows($sync_result);
  \mysql_close($sync_connection);
  return $result->numRows() + $sync_rows;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
resource(%d) of type (mysql link)
Connection destroyed when released
int(%d)
```.example.hhvm.out
resource(4) of type (mysql link)
Connection destroyed when released
int(2)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
