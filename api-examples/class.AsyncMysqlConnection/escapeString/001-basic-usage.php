<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\EscapeString;

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

async function get_data(\AsyncMysqlConnection $conn, string $name):
  Awaitable<\AsyncMysqlQueryResult> {
  $escaped_name = $conn->escapeString($name);
  var_dump($escaped_name);
  return await $conn->queryf(
    'SELECT age FROM test_table where name = %s',
    $escaped_name
  );
}
async function simple_queryf(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $result = await get_data($conn, 'Joel Marcey');
  $x = $result->numRows();
  $result = await get_data($conn, 'Daffy\nDuck');
  $conn->close();
  return $x + $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_queryf());
}

run();
