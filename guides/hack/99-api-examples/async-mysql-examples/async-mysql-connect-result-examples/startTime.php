<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ConnResult\ElapsedMic;

require __DIR__ .'/../connect.inc.php';

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
  $st = $conn->connectResult()->endTime();
  $conn->close();
  return $st;
}

function run(): void {
  $st = \HH\Asio\join(get_connection_start_time());
  var_dump($st);
}

run();
