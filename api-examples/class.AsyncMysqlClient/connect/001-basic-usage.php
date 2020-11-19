<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Client\Conn;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function do_connect(): Awaitable<\AsyncMysqlQueryResult> {
  // Cast because the array from get_connection_info() is a mixed
  $conn = await \AsyncMysqlClient::connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
  return await $conn->query('SELECT * FROM test_table');
}

function run_it(): void {
  $res = \HH\Asio\join(do_connect());
  \var_dump($res->numRows()); // The number of rows from the SELECT statement
}

<<__EntryPoint>>
function basic_usage_main(): void {
  require __DIR__."/../../__includes/async_mysql_connect.inc.php";

  run_it();
}
