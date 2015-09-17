<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Conn\MultiQuery;

require __DIR__ .'/../connect.inc.php';

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
async function simple_multi_query(): Awaitable<int> {
  // In our test database, the third query will return an empty result since
  // we do not have a user ID of 3.
  $queries = array(
    'SELECT name FROM test_table WHERE userID = 1',
    'SELECT age, email FROM test_table WHERE userID = 2',
    'SELECT name FROM test_table WHERE userID = 3',
  );
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  $results = await $conn->multiQuery($queries);
  $conn->close();
  $x = 0;
  foreach ($results as $result) {
    $x += $result->numRows();
  }
  return $x;
}

function run(): void {
  $r = \HH\Asio\join(simple_multi_query());
  var_dump($r);
}

run();
