<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ConnResult\ElapsedMic;

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
async function get_connection_time(): Awaitable<?int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $em = $conn->connectResult()?->elapsedMicros();
  $conn->close();
  return $em;
}

function run(): void {
  $em = \HH\Asio\join(get_connection_time());
  \var_dump($em);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';

  run();
}
