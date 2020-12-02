`AsyncMysqlConnection::multiQuery` is similar to `AsyncMysqlConnection::query`, except that you can pass an array of queries to run one after the other. Then when you `await` on the call, you will get a `Vector` of `AsyncMysqlQueryResult`, one result for each query.

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
async function simple_multi_query(): Awaitable<int> {
  // In our test database, the third query will return an empty result since
  // we do not have a user ID of 3.
  $queries = Vector {
    'SELECT name FROM test_table WHERE userID = 1',
    'SELECT age, email FROM test_table WHERE userID = 2',
    'SELECT name FROM test_table WHERE userID = 3',
  };
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $results = await $conn->multiQuery($queries);
  $conn->close();
  $x = 0;
  foreach ($results as $result) {
    $x += $result->numRows();
  }
  return $x;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_multi_query();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(1)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
