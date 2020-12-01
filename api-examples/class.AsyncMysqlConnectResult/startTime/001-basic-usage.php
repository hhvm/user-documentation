<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ConnResult\StartTime;

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
  $st = $conn->connectResult()?->endTime();
  $conn->close();
  return $st;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();
  $st = await get_connection_start_time();
  \var_dump($st);
}
