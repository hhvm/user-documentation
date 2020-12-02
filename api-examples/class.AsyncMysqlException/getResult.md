The following example shows how to use `AsyncMysqlException::getResult` to get the `AsyncMysqlErrorResult` object associated with this exception. Particularly, we call `elapsedMicros()` on that object.

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
  $ret = null;
  try {
    $conn = await connect($pool);
    $result = await $conn->query(
      'SELECT name FROM test_table WHERE userID = 1',
    );
    $conn->close();
    return $result->vectorRows()[0][0];
  } catch (\AsyncMysqlConnectException $ex) { // implicitly constructed
    $ret = "Connection Exception";
    \var_dump($ex->getResult()->elapsedMicros());
  } catch (\AsyncMysqlQueryException $ex) { // implicitly constructed
    $ret = "Query Exception";
  } catch (\AsyncMysqlException $ex) {
    $ret = null;
  } finally {
    if ($conn) {
      $conn->close();
    }
  }
  return $ret;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
string(20) "Connection Exception"
```.example.hhvm.out
int(4710)
string(20) "Connection Exception"
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
