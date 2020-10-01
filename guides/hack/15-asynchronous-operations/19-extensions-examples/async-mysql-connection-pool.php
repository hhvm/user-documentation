<?hh

namespace Hack\UserDocumentation\AsyncOps\Extensions\Examples\MySQLConnectionPool;

use \Hack\UserDocumentation\AsyncOps\Extensions\Examples\AsyncMysql\ConnectionInfo as CI
;

function get_pool(): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool(
    darray['pool_connection_limit' => 100],
  ); // See API for more pool options
}

async function get_connection(): Awaitable<\AsyncMysqlConnection> {
  $pool = get_pool();
  $conn = await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
  return $conn;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  require __DIR__.'/async_mysql_connect.inc.php';
  $conn = await get_connection();
  \var_dump($conn);
}
