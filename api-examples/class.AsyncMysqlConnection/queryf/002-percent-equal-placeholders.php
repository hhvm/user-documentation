<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\Queryf\PerEqual;

require __DIR__ .'/../../__includes/async_mysql_connect.inc.php';

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(\AsyncMysqlConnectionPool $pool):
  Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd
  );
}

async function get_data(
  \AsyncMysqlConnection $conn,
  string $col,
  ?string $email):
  Awaitable<\AsyncMysqlQueryResult> {
  // %=s allows you to check an actual string value or IS NULL
  return await $conn->queryf(
    'SELECT %C FROM test_table where email %=s',
    $col,
    $email
  );
}

async function simple_queryf(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $result = await get_data($conn, 'name', 'joelm@fb.com');
  $x = $result->numRows();
  $result = await get_data($conn, 'name', null);
  $conn->close();
  return $x + $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_queryf());
  var_dump($r);
}

run();
