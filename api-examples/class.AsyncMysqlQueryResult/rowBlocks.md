The following example shows how a call to `AsyncMysqlQueryResult::rowBlocks` gets you a `Vector` of `AsyncMysqlRowBlock` objects. Each object can then be queried for statistical data on that row, such as the number of fields that came back with the result, etc.

**NOTE**: A call to `rowBlocks()` actually pops the first element of that `Vector`. So, for example, if you have the following:

```
object(HH\Vector)#9 (1) {
  [0]=>
  object(AsyncMysqlRowBlock)#10 (0) {
  }
}
```

a call to `rowBlocks()` will make it so that you know have:

```
object(HH\Vector)#9 (0) {
}
```

and thus a subsequent call to `rowBlocks()` will return an empty `Vector`.

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
  $result = await $conn->query('SELECT * FROM test_table WHERE userID < 50');
  // A call to $result->rowBlocks() actually pops the first element of the
  // row block Vector. So it mutates it.
  $row_blocks = $result->rowBlocks();
  if ($row_blocks->count() > 0) {
    // An AsyncMysqlRowBlock
    $row_block = $row_blocks[0];
    \var_dump($row_block->fieldName(2)); // string
  } else {
    \var_dump('nothing');
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
string(%d) "%s"
int(%d)
```.example.hhvm.out
string(3) "age"
int(1)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
