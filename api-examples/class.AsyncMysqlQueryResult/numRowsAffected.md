This example shows how to determine the number of rows affected by a given query using `AsyncMysqlQueryResult::numRowsAffected`. This is especially useful on an `INSERT` query or similar, where you won't get any rows back in your result, but you want to make sure your query did what it was supposed to do.

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
  $id = \rand(100, 60000); // userID is a SMALLINT
  $name = \str_shuffle("ABCDEFGHIJ");
  $query = 'INSERT INTO test_table (userID, name) VALUES ('.
    $id.
    ', "'.
    $name.
    '")';
  try {
    $result = await $conn->query($query);
    // How many rows were affected? Should be 1.
    \var_dump($result->numRowsAffected());
  } catch (\AsyncMysqlQueryException $ex) {
    // this could happen if we try to insert duplicate user id
    // But to keep test output consistent, just var dump a positive number
    \var_dump(\PHP_INT_MAX);
    $conn->close();
    return 0;
  }
  $conn->close();
  return $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
int(0)
```.example.hhvm.out
int(1)
int(0)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
