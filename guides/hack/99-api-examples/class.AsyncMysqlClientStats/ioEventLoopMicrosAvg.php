<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\CStats\IOELMicros;

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
async function get_loop_info(): Awaitable<float> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $loop = $conn->connectResult()->clientStats()->ioEventLoopMicrosAvg();
  $conn->close();
  return $loop;
}

function run(): void {
  $l = \HH\Asio\join(get_loop_info());
  var_dump($l);
}

run();
