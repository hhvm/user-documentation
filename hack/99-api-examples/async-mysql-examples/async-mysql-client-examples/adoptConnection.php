<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Client\AdoptConn;

require __DIR__ . "/../connect.inc";

function get_synchronous_connection(): resource {
  list($host, $port, $db, $user, $passwd) = \get_connection_info();
  $conn = mysql_connect($host, $user, $passwd);
  mysql_select_db($db, $conn);
  return $conn;
}

function use_async_connection(resource $sync_conn): \AsyncMysqlConnection {
  return \AsyncMysqlClient::adoptConnection($sync_conn);
}

async function get_rows(\AsyncMysqlConnection $conn):
  Awaitable<\AsyncMysqlQueryResult> {
  return await $conn->query('SELECT * FROM test_table');
}

function run_it(): void {
  $sconn = get_synchronous_connection();
  $aconn = use_async_connection($sconn);
  $rows = \HH\Asio\join(get_rows($aconn));
  var_dump($rows->numRows()); // The number of rows from the SELECT statement
}

run_it();
