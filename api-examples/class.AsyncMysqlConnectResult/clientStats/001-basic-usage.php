<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ConnResult\ClientStats;

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
async function get_client_stats(): Awaitable<?\AsyncMysqlClientStats> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $cstats = $conn->connectResult()?->clientStats();
  \var_dump($cstats?->callbackDelayMicrosAvg());
  $conn->close();
  return $cstats;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();
  $cs = await get_client_stats();
  \var_dump($cs);
}
