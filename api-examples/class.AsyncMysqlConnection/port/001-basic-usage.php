<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\Port;

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
async function get_port(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $port = $conn->port();
  $conn->close();
  return $port;
}

function run(): void {
  $port = \HH\Asio\join(get_port());
  \var_dump($port);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';

  run();
}
