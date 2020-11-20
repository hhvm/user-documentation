<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\CStats\CBackDelayMicro;

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
async function get_delay(): Awaitable<?float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $delay = $conn->connectResult()?->clientStats()?->callbackDelayMicrosAvg();
  $conn->close();
  return $delay;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';
  $d = await get_delay();
  \var_dump($d);
}
