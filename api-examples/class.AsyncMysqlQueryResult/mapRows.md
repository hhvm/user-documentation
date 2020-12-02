When executing a query, you can get the rows returned from it in the form of a `Vector` of `Map` objects, where each key of the `Map` is a column name. This example shows how to use `AsyncMysqlQueryResult::mapRows` to get that `Map`. A resulting `Map` may look like:

```
object(HH\Vector)#9 (2) {
  [0]=>
  object(HH\Map)#10 (1) {
    ["name"]=>
    string(11) "Joel Marcey"
  }
  [1]=>
  object(HH\Map)#11 (1) {
    ["name"]=>
    string(11) "Fred Emmott"
  }
}
```

Note that all values in the `Map` returned from `mapRows` will be `string` or `null`. If you want specifically-typed values, use `mapRowsTyped`

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
  $result = await $conn->query('SELECT name FROM test_table WHERE userID < 50');
  \var_dump($result->mapRows()->count() === $result->numRows());
  $conn->close();
  return $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
bool(true)
int(%d)
```.example.hhvm.out
bool(true)
int(1)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
