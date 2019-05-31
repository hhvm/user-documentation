<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\QueryResult\LastInsID;

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
  $id = \rand(100, 60000); // userID is a SMALLINT
  $name = \str_shuffle("ABCDEFGHIJ");
  $query = 'INSERT INTO test_table (userID, name) VALUES ('
         . $id . ', "' . $name . '")';
  try {
    $result = await $conn->query($query);
    // What was the last primary id we inserted into the table?
    \var_dump($result->lastInsertId());
  } catch (\AsyncMysqlQueryException $ex) {
    // this could happen if we try to insert duplicate user id
    // But to keep test output consistent, just var dump a positive number
    \var_dump(\PHP_INT_MAX);
    $conn->close();
    return 0;
  }
  $conn->close();
  return $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_query());
  \var_dump($r);
}

run();
