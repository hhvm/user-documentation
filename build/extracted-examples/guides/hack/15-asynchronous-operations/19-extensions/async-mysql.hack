// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Extensions\AsyncMysql;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function get_connection(): Awaitable<\AsyncMysqlConnection> {
  // Get a connection pool with default options
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  // Change credentials to something that works in order to test this code
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
}

async function fetch_user_name(
  \AsyncMysqlConnection $conn,
  int $user_id,
): Awaitable<?string> {
  // Your table and column may differ, of course
  $result = await $conn->queryf(
    'SELECT name from test_table WHERE userID = %d',
    $user_id,
  );
  // There shouldn't be more than one row returned for one user id
  invariant($result->numRows() === 1, 'one row exactly');
  // A vector of vector objects holding the string values of each column
  // in the query
  $vector = $result->vectorRows();
  return $vector[0][0]; // We had one column in our query
}

async function get_user_info(
  \AsyncMysqlConnection $conn,
  string $user,
): Awaitable<Vector<Map<string, ?string>>> {
  $result = await $conn->queryf(
    'SELECT * from test_table WHERE name %=s',
    $user,
  );
  // A vector of map objects holding the string values of each column
  // in the query, and the keys being the column names
  $map = $result->mapRows();
  return $map;
}

<<__EntryPoint>>
async function async_mysql_tutorial(): Awaitable<void> {
  \init_docs_autoloader();

  $conn = await get_connection();
  if ($conn !== null) {
    $result = await fetch_user_name($conn, 2);
    \var_dump($result);
    $info = await get_user_info($conn, 'Fred Emmott');
    \var_dump($info is vec<_>);
    \var_dump($info[0] is dict<_, _>);
  }
}
