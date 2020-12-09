<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassAsyncMysqlConnectionMethodIsReusable\BasicUsage;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(
  \AsyncMysqlConnectionPool $pool,
): Awaitable<\AsyncMysqlConnection> {
  $conn = await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
  // By default pool connections are automatically set to be reusable
  $conn->setReusable(false);
  return $conn;
}

async function simple_query(\AsyncMysqlConnection $conn): Awaitable<int> {
  $result = await $conn->query('SELECT name FROM test_table WHERE userID = 1');
  return $result->numRows();
}

async function simple_query_2(\AsyncMysqlConnection $conn): Awaitable<int> {
  $result = await $conn->query('SELECT name FROM test_table WHERE userID = 2');
  return $result->numRows();
}

async function get_connection(
  \AsyncMysqlConnectionPool $pool,
): Awaitable<\AsyncMysqlConnection> {
  return await connect($pool);
}

function get_pool(): \AsyncMysqlConnectionPool {
  $options = darray[
    'pool_connection_limit' => 1,
  ];
  return new \AsyncMysqlConnectionPool($options);
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $pool = get_pool();

  $conn = await get_connection($pool);
  // This will be false now
  \var_dump($conn->isReusable());
  $r2 = await simple_query($conn);
  $conn->close();

  $conn2 = await get_connection($pool);
  $r2 = await simple_query_2($conn2);
  // You will see one destroyed pool connection since we close $conn above
  // and we didn't set it to be reusable
  \var_dump($pool->getPoolStats());
  $conn2->close();
}
