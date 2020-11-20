<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\WarningCount;

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
async function get_warning_count_on_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await $conn->query('SELECT name FROM test_table WHERE userID = 1');
  $wc = $conn->warningCount();
  $conn->close();
  return $wc;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';
  $wc = await get_warning_count_on_query();
  \var_dump($wc);
}
