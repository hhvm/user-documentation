The following example shows how to use `AsyncMysqlRow::at` to get a field value from the resulting row block. In this case, we get a `Vector` of `AsyncMysqlRowBlock`s, then the first row block in that `Vector`, then the first `AsyncMysqlRow` in that row block. Finally, we get the value of the `age` field in that row.

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
  $conn->close();
  // A call to $result->rowBlocks() actually pops the first element of the
  // row block Vector. So the call actually mutates the Vector.
  $row_blocks = $result->rowBlocks();
  if (!$row_blocks->isEmpty()) {
    // An AsyncMysqlRowBlock
    $row_block = $row_blocks[0];
    if (!$row_block->isEmpty()) {
      // An AsyncMysqlRow
      $row = $row_block->getRow(0);
      return (int)$row->at("age");
    }
    return -1;
  } else {
    return -1;
  }
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $r = await simple_query();
  \var_dump($r);
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(42)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
