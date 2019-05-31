<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\Close;

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
async function simple_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $result = await $conn->query('SELECT name FROM test_table WHERE userID = 1');
  $conn->close();
  try {
    $result2 = await $conn->query(
      'SELECT name FROM test_table WHERE userID = 1'
    );
  } catch (\Exception $ex) {  // probably InvalidArgumentException on query
    echo "Connection closed\n";
  }
  return $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_query());
  \var_dump($r);
}

run();
