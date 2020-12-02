When executing a query, you can get the rows returned from it in the form of a `Vector` of `Vector` objects, where each value of the `Vector` is a column value. This example shows how to use `AsyncMysqlQueryResult::vectorRows` to get that `Vector`. A resulting `Vector` may look like:

```
object(HH\Vector)#9 (2) {
  [0]=>
  object(HH\Vector)#10 (1) {
    [0]=>
    string(11) "Joel Marcey"
  }
  [1]=>
  object(HH\Vector)#11 (1) {
    [0]=>
    string(11) "Fred Emmott"
  }
}
```

Note that all values in the `Vector` returned from `vectorRows` will be `string` or `null`. If you want specifically-typed values, use `vectorRowsTyped`.

Also understand that if you want the actual column names associated with the values in the `Vector`, you should use `mapRows` instead.

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
  \var_dump($result->vectorRows()->count() === $result->numRows());
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
