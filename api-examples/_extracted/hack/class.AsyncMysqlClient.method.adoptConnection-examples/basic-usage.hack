<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassAsyncMysqlClientMethodAdoptConnection\BasicUsage;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

function get_synchronous_connection(): resource {
  $conn = \mysql_connect(CI::$host, CI::$user, CI::$passwd);
  \mysql_select_db(CI::$db, $conn);
  return $conn;
}

function use_async_connection(resource $sync_conn): \AsyncMysqlConnection {
  return \AsyncMysqlClient::adoptConnection($sync_conn);
}

async function get_rows(
  \AsyncMysqlConnection $conn,
): Awaitable<\AsyncMysqlQueryResult> {
  return await $conn->query('SELECT * FROM test_table');
}

<<__EntryPoint>>
async function run_it(): Awaitable<void> {
  \init_docs_autoloader();

  $sconn = get_synchronous_connection();
  $aconn = use_async_connection($sconn);
  $rows = await get_rows($aconn);
  \var_dump($rows->numRows()); // The number of rows from the SELECT statement
}
