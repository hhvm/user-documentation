<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ConnPool\construct;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

function set_connection_pool(darray $options): \AsyncMysqlConnectionPool {
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

function run_it(): void {
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
    $conns = \HH\Asio\join(\HH\Asio\v($conn_awaitables));
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
  $conn = \HH\Asio\join(connect_with_pool($pool));
  \sleep(10); // Idle for 5 seconds. So should timeout here.
  try {
    $result = \HH\Asio\join($conn->query("SELECT * FROM test_table"));
  } catch (\AsyncMysqlQueryException $ex) {
    echo "Hit idle limit";
  }
}

<<__EntryPoint>>
function basic_usage_main(): void {
  require __DIR__."/../../__includes/async_mysql_connect.inc.php";

  run_it();
}
