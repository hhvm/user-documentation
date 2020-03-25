<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\Host;

require __DIR__.'/../../__includes/async_mysql_connect.inc.php';

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
async function get_host(): Awaitable<string> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $info = $conn->host();
  $conn->close();
  return $info;
}

function run(): void {
  $info = \HH\Asio\join(get_host());
  \var_dump($info);
}

run();
