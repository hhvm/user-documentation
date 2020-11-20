<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\CStats\IOELMicros;

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
async function get_loop_info(): Awaitable<?float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $loop = $conn->connectResult()?->clientStats()?->ioEventLoopMicrosAvg();
  $conn->close();
  return $loop;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';
  $l = await get_loop_info();
  \var_dump($l);
}
