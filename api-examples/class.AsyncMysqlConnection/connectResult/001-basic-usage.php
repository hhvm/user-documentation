<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\ConnResult;

require __DIR__.'/../../__includes/async_mysql_connect.inc.php';

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
async function get_connect_time(): Awaitable<?int> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $result = $conn->connectResult(); // returns ?\AsyncMysqlConnectResult
  $conn->close();
  return $result?->elapsedMicros();
}

function run(): void {
  $time = \HH\Asio\join(get_connect_time());
  \var_dump($time);
}

run();
