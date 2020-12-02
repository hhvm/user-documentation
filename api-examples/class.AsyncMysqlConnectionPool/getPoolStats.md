The following example shows how to gather `AsyncMySqlConnectionPool` statistics using its `getStats()` method. The statistics that are gathered are connection statistics.

```basic-usage.php
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;


function set_connection_pool(
  darray<string, mixed> $options = darray[],
): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool($options);
}

async function connect_with_pool(
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

function get_stats(\AsyncMysqlConnectionPool $pool): mixed {
  return $pool->getPoolStats();
}

<<__EntryPoint>>
async function run_it(): Awaitable<void> {
  $pool = set_connection_pool();
  $conn_awaitables = Vector {};
  $conn_awaitables[] = connect_with_pool($pool);
  $conn_awaitables[] = connect_with_pool($pool);
  $conn_awaitables[] = connect_with_pool($pool);
  $conns = await \HH\Asio\v($conn_awaitables);
  // Get pool connection stats, like pool connections created, how many
  // connections were requested, etc.
  \var_dump(get_stats($pool));
}
```.hhvm.expectf
darray(5) {
  ["created_pool_connections"]=>
  int(3)
  ["destroyed_pool_connections"]=>
  int(0)
  ["connections_requested"]=>
  int(3)
  ["pool_hits"]=>
  int(%d)
  ["pool_misses"]=>
  int(%d)
}
```.example.hhvm.out
darray(5) {
  ["created_pool_connections"]=>
  int(3)
  ["destroyed_pool_connections"]=>
  int(0)
  ["connections_requested"]=>
  int(3)
  ["pool_hits"]=>
  int(0)
  ["pool_misses"]=>
  int(3)
}
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
