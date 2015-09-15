<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Client\setPCL;

require __DIR__ . "/../connect.inc.php";

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

function set_connection_pool(): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool(array());
}

async function connect_with_pool(\AsyncMysqlConnectionPool $pool):
  Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd
  );
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
