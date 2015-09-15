<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Client\setPCL;

require __DIR__ . "/../connect.inc.php";

function set_connection_pool(): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool(array());
}

async function connect_with_pool(\AsyncMysqlConnectionPool $pool):
  Awaitable<\AsyncMysqlConnection> {
  list($host, $port, $db, $user, $passwd) = \get_connection_info();
  return await $pool->connect($host, $port, $db, $user, $passwd);
}

function get_stats(\AsyncMysqlConnectionPool $pool): array<mixed> {
  return $pool->getPoolStats();
}

function run_it(): void {
  \AsyncMysqlClient::setPoolsConnectionLimit(2);
  $pool = set_connection_pool();
  $conn_waitHandles = Vector {};
  try {
    $conn_waitHandles[] = connect_with_pool($pool);
    $conn_waitHandles[] = connect_with_pool($pool);
    // This connection here will throw the exception when we join
    $conn_waitHandles[] = connect_with_pool($pool);
    $conns = \HH\Asio\join(\HH\Asio\v($conn_waitHandles));
  } catch (\AsyncMysqlConnectException $ex) {
    var_dump(get_stats($pool));
  }
}

run_it();
