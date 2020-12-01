<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\LastActTime;

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
async function get_time(): Awaitable<float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $t = $conn->lastActivityTime();
  $conn->close();
  return $t;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();
  $t = await get_time();
  \var_dump($t);
}
