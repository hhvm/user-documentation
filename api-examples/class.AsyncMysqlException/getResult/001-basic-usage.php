<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Except\GetRes;

require __DIR__ .'/../../__includes/async_mysql_connect.inc.php';

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(\AsyncMysqlConnectionPool $pool):
  Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    "thisIsNotThePassword"
  );
}
async function simple_query(): Awaitable<?string> {
  $pool = new \AsyncMysqlConnectionPool(array());
  $conn = null;
  $ret = null;
  try {
    $conn = await connect($pool);
    $result = await $conn->query(
      'SELECT name FROM test_table WHERE userID = 1'
    );
    $conn->close();
    return $result->vectorRows()[0];
  } catch (\AsyncMysqlConnectException $ex) { // implicitly constructed
    $ret = "Connection Exception";
    var_dump($ex->getResult()->elapsedMicros());
  } catch (\AsyncMysqlQueryException $ex) { // implicitly constructed
    $ret = "Query Exception";
  } catch (\AsyncMysqlException $ex) {
    $ret = null;
  } finally {
    if ($conn) {
      $conn->close();
    }
  }
  return $ret;
}

function run(): void {
  $r = \HH\Asio\join(simple_query());
  var_dump($r);
}

run();
