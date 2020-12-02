The following example shows you how to create an `AsyncMysqlConnectionPool` with various options, and then connect to MySQL asynchronously using those pool options. The various pool options that you can construct an AsyncMysqlConnectionPool with are:

* `connection_limit` - Defines the limit of opened connections for each set of User, Database, Host, etc.
* `total_connection_limit` - Defines the total limit of opened connection as a whole.
* `idle_timeout_micros` - Sets the maximum idle time in microseconds a connection can be left in the pool without being killed by the pool.
* `age_timeout_micros` - Sets the maximum age (means the time since started) of a connection, the pool will then kill this connection when reaches that limit.
* `expiration_policy` - There are 2 policies for the expiration of a connection: `IdleTime` and `Age`, in the Idle policy a connection will only die after some time being idle; in Age policy we extend the idle one to kill also by age.

This example focuses on the `connection_limit` and `idle_timeout_micros` options.

```basic-usage.php
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

function set_connection_pool(
  darray<string, mixed> $options,
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

function get_stats(\AsyncMysqlConnectionPool $pool): dict<string, int> {
  return dict($pool->getPoolStats());
}

<<__EntryPoint>>
async function run_it(): Awaitable<void> {
  $options = darray[
    'pool_connection_limit' => 2,
  ];
  // We will have a 2 pool connection limit
  $pool = set_connection_pool($options);
  $conn_awaitables = Vector {};
  try {
    // One of these three connections will throw the exception when we join
    // because we are going beyond our connection limit
    $conn_awaitables[] = connect_with_pool($pool);
    $conn_awaitables[] = connect_with_pool($pool);
    $conn_awaitables[] = connect_with_pool($pool);
    $conns = await \HH\Asio\v($conn_awaitables);
  } catch (\AsyncMysqlConnectException $ex) {
    $stats = get_stats($pool);
    echo "Allowed pool connections: ".
      $stats['created_pool_connections'].
      \PHP_EOL.
      "Requested pool connections: ".
      $stats['connections_requested'].
      \PHP_EOL;
  }

  $options = darray[
    'idle_timeout_micros' => 2000000,
    'expiration_policy' => 'IdleTime',
  ];
  $pool = set_connection_pool($options);
  $conn = await connect_with_pool($pool);
  \sleep(10); // Idle for 5 seconds. So should timeout here.
  try {
    $result = await $conn->query("SELECT * FROM test_table");
  } catch (\AsyncMysqlQueryException $ex) {
    echo "Hit idle limit";
  }
}
```.hhvm.expect
Allowed pool connections: 2
Requested pool connections: 3
Hit idle limit
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
