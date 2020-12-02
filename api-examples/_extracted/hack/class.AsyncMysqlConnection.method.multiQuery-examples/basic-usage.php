<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassAsyncMysqlConnectionMethodMultiQuery\BasicUsage;

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
async function simple_multi_query(): Awaitable<int> {
  // In our test database, the third query will return an empty result since
  // we do not have a user ID of 3.
  $queries = Vector {
    'SELECT name FROM test_table WHERE userID = 1',
    'SELECT age, email FROM test_table WHERE userID = 2',
    'SELECT name FROM test_table WHERE userID = 3',
  };
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $results = await $conn->multiQuery($queries);
  $conn->close();
  $x = 0;
  foreach ($results as $result) {
    $x += $result->numRows();
  }
  return $x;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $r = await simple_multi_query();
  \var_dump($r);
}
