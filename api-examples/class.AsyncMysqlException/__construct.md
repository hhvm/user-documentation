The following example shows how to catch an `AsyncMysqlException`. Normally you would construct one implicitly via a `try/catch` block, like we did in this example. 

The two current subclasses of `AsyncMysqlException` are `AsyncMysqlConnectionException` for connection problems and `AsyncMysqlQueryException` for querying issues.

Note that you can explicitly construct one by creating an object like `new AsyncMysqlException(AsyncMysqlErrorResult $result)`. But this is not normally done.

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
    "thisIsNotThePassword",
  );
}
async function simple_query(): Awaitable<?string> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = null;
  try {
    $conn = await connect($pool);
    $result = await $conn->query(
      'SELECT name FROM test_table WHERE userID = 1',
    );
    $conn->close();
    return $result->vectorRows()[0][0];
  } catch (\AsyncMysqlConnectException $ex) { // implicitly constructed
    return "Connection Exception";
  } catch (\AsyncMysqlQueryException $ex) { // implicitly constructed
    return "Query Exception";
  } catch (\AsyncMysqlException $ex) {
    return null;
  } finally {
    if ($conn) {
      $conn->close();
    }
  }
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
string(20) "Connection Exception"
```.example.hhvm.out
string(20) "Connection Exception"
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
