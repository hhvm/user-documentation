<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\ErrorResult\MysqlNErr;

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
async function simple_query_error(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  try {
    $result = await $conn->query('SELECT bogus FROM bogus WHERE bogus = 1');
  } catch (\AsyncMysqlQueryException $ex) {
    $qr = $ex->getResult();
    // Actually `AsyncMysqlQueryErrorResult`
    \var_dump($qr is \AsyncMysqlErrorResult);
    // Error should be "Table doesn't exist...""
    \var_dump($qr->mysql_normalize_error());
    $conn->close();
    return 0;
  }
  $conn->close();
  return $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_query_error());
  \var_dump($r);
}

run();
