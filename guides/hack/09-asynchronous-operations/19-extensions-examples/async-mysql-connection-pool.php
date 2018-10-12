<?hh

namespace Hack\UserDocumentation\Async\Extensions\Examples\AsyncMySQLConnectionPool;

require __DIR__ . '/async-mysql-connect.inc.php';

use \Hack\UserDocumentation\Async\Extensions\Examples\AsyncMysql\ConnectionInfo as CI;

function get_pool(): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool(
    array('pool_connection_limit' => 100)
  ); // See API for more pool options
}

async function get_connection(): Awaitable<\AsyncMysqlConnection> {
  $pool = get_pool();
  $conn = await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
  return $conn;
}

async function run(): Awaitable<void> {
  $conn = await get_connection();
  \var_dump($conn);
}

<<__Entrypoint>>
function main(): void {
  \HH\Asio\join(run());
}

