This example shows how we can get the number of successful queries of a multi-query, even though one of those queries gave us an error (which we caught in the exception). This is done via `AsyncMysqlQueryErrorResult::numSuccessfulQueries`.

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
async function multi_query_error(): Awaitable<?int> {
  $queries = Vector {
    'SELECT name FROM test_table WHERE userID = 1',
    'SELECT age, email FROM test_table WHERE userID = 2',
    'SELECT bogus FROM bogus WHERE bogus = 1',
  };
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  try {
    $result = await $conn->multiQuery($queries);
  } catch (\AsyncMysqlQueryException $ex) {
    $qr = $ex->getResult();
    \var_dump($qr is \AsyncMysqlQueryErrorResult);
    // Constructor to the exception takes AsyncMysqlErrorResult, need to
    // ensure typechecker that we have an AsyncMysqlQueryErrorResult
    invariant($qr is \AsyncMysqlQueryErrorResult, "Bad news if not");
    \var_dump($qr->numSuccessfulQueries());
    $conn->close();
    return null;
  }
  $conn->close();
  return $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await multi_query_error();
  \var_dump($r);
}
```.hhvm.expectf
bool(true)
int(%d)
NULL
```.example.hhvm.out
bool(true)
int(2)
NULL
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
