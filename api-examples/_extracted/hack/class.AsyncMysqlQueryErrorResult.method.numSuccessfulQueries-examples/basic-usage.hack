<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassAsyncMysqlQueryErrorResultMethodNumSuccessfulQueries\BasicUsage;

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
async function multi_query_error(): Awaitable<?int> {
  $queries = Vector {
    'SELECT name FROM test_table WHERE userID = 1',
    'SELECT age, email FROM test_table WHERE userID = 2',
    'SELECT bogus FROM bogus WHERE bogus = 1',
  };
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  try {
    $result = await $conn->multiQuery($queries);
  } catch (\AsyncMysqlQueryException $ex) {
    $qr = $ex->getResult();
    \var_dump($qr is \AsyncMysqlQueryErrorResult);
    // Constructor to the exception takes AsyncMysqlErrorResult, need to
    // ensure typechecker that we have an AsyncMysqlQueryErrorResult
    invariant($qr is \AsyncMysqlQueryErrorResult, "Bad news if not");
    \var_dump($qr->numSuccessfulQueries());
    $conn->close();
    return null;
  }
  $conn->close();
  return $result->numRows();
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $r = await multi_query_error();
  \var_dump($r);
}
