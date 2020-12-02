Every successful query has a result. And one of the methods on an `AsyncMysqlQueryResult` is `startTime()`, which tells you the time when we started to get our result.

Note that 

```
  elapsedMicros() ~== endTime() - startTime()
```

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
  // What time was it when we started to get this result?
  \var_dump($result->startTime());
  $conn->close();
  return $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
float(%f)
int(%d)
```.example.hhvm.out
float(17311.243147)
int(1)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
