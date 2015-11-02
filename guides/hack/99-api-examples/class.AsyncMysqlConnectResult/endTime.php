<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ConnResult\EndTime;

require __DIR__ .'/../__includes/async_mysql_connect.inc.php';

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(\AsyncMysqlConnectionPool $pool):
  Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd
  );
}
async function get_connection_start_time(): Awaitable<float> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $et = $conn->connectResult()->endTime();
  $conn->close();
  return $et;
}

function run(): void {
  $et = \HH\Asio\join(get_connection_start_time());
  var_dump($et);
}

run();
