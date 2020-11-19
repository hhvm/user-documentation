<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\Queryf\PerL;

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

async function get_data(
  \AsyncMysqlConnection $conn,
  Vector<int> $ids,
): Awaitable<\AsyncMysqlQueryResult> {
  return await $conn->queryf(
    'SELECT name FROM test_table where userID IN (%Ld)',
    $ids,
  );
}

async function percent_L_queryf(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $ids = Vector {1, 2};
  $result = await get_data($conn, $ids);
  $conn->close();
  return $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(percent_L_queryf());
  \var_dump($r);
}

<<__EntryPoint>>
function percent_L_placeholders_main(): void {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';

  run();
}
