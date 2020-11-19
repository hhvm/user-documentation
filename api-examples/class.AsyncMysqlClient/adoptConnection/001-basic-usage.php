<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Client\AdoptConn;

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

function run_it(): void {
  $sconn = get_synchronous_connection();
  $aconn = use_async_connection($sconn);
  $rows = \HH\Asio\join(get_rows($aconn));
  \var_dump($rows->numRows()); // The number of rows from the SELECT statement
}

<<__EntryPoint>>
function basic_usage_main(): void {
  require __DIR__."/../../__includes/async_mysql_connect.inc.php";

  run_it();
}
