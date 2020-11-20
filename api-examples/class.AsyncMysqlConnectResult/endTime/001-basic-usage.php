<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ConnResult\EndTime;

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
async function get_connection_start_time(): Awaitable<?float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $et = $conn->connectResult()?->endTime();
  $conn->close();
  return $et;
}

<<__EntryPoint>>
function run(): void {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';
  $et = \HH\Asio\join(get_connection_start_time());
  \var_dump($et);
}
