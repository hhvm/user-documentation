<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\QueryResult\CStats;

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
async function simple_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await $conn->query('SELECT name FROM test_table WHERE userID = 1');
  \var_dump($result->clientStats()->callbackDelayMicrosAvg());
  $conn->close();
  return $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();
  $r = await simple_query();
  \var_dump($r);
}
