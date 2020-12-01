<?hh

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

<<__EntryPoint>>
async function run_it(): Awaitable<void> {
  \init_docs_autoloader();
  $res = await do_connect();
  \var_dump($res->numRows()); // The number of rows from the SELECT statement
}
