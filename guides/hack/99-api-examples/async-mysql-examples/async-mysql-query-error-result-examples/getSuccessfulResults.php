<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\QueryErrorRes\SuccRes;

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
async function simple_query_error(): Awaitable<?int> {
  $queries = Vector {
    'SELECT name FROM test_table WHERE userID = 1',
    'SELECT age, email FROM test_table WHERE userID = 2',
    'SELECT bogus FROM bogus WHERE bogus = 1',
  };
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = await connect($pool);
  try {
    $result = await $conn->multiQuery($queries);
  } catch (\AsyncMysqlQueryException $ex) {
    $qr = $ex->getResult();
    // Actually `AsyncMysqlQueryErrorResult`
    var_dump($qr instanceof \AsyncMysqlErrorResult);
    $rows = 0;
    // Ok, we had an error in our multiquery, but maybe we had some
    // successful results in some of the queries.
    if (array_key_exists(0, $qr->getSuccessfulResults())) {
      $rows = $qr->getSuccessfulResults()[0]->numRows();
    }
    var_dump($rows);
    $conn->close();
    return null;
  }
  $conn->close();
  return $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_query_error());
  var_dump($r);
}

run();
