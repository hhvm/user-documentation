It is **highly recommended** that you use connection pools when using async MySQL. That way you don't have to create a new connection every time you want to make a query to the database. The following example shows you how to connect to a MySQL database using an `AsyncMySqlConnectionPool`.

```basic-usage.php
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

class MyPool {
  private \AsyncMysqlConnectionPool $pool;

  public function __construct() {
    $this->pool = new \AsyncMysqlConnectionPool(darray[]);
  }

  public function getPool(): \AsyncMysqlConnectionPool {
    return $this->pool;
  }

  public async function connect(): Awaitable<\AsyncMysqlConnection> {
    return await $this->pool
      ->connect(CI::$host, CI::$port, CI::$db, CI::$user, CI::$passwd);
  }
}


async function get_num_rows(\AsyncMysqlConnection $conn): Awaitable<int> {
  $result = await $conn->query('SELECT * FROM test_table');
  return $result->numRows();
}

async function get_row_data(
  \AsyncMysqlConnection $conn,
): Awaitable<Vector<KeyedContainer<int, ?string>>> {
  $result = await $conn->query('SELECT * FROM test_table');
  return $result->vectorRows();
}

async function run_it_1(MyPool $pool): Awaitable<void> {
  $conn = await $pool->connect();
  $rows = await get_num_rows($conn);
  \var_dump($rows);
}

async function run_it_2(MyPool $pool): Awaitable<void> {
  $conn = await $pool->connect();
  $data = await get_row_data($conn);
  \var_dump($data->count());
  // Should show only one created pool connection since we are pooling it
  \var_dump($pool->getPool()->getPoolStats());
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $pool = new MyPool();
  await run_it_1($pool);
  await run_it_2($pool);
}
```.hhvm.expectf
int(%d)
int(%d)
darray(5) {
  ["created_pool_connections"]=>
  int(1)
  ["destroyed_pool_connections"]=>
  int(0)
  ["connections_requested"]=>
  int(2)
  ["pool_hits"]=>
  int(%d)
  ["pool_misses"]=>
  int(%d)
}
```.example.hhvm.out
int(21)
int(21)
darray(5) {
  ["created_pool_connections"]=>
  int(1)
  ["destroyed_pool_connections"]=>
  int(0)
  ["connections_requested"]=>
  int(2)
  ["pool_hits"]=>
  int(1)
  ["pool_misses"]=>
  int(1)
}
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
