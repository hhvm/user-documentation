<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Client\Conn;

require __DIR__ . "/../connect.inc.php";

async function do_connect(): Awaitable<\AsyncMysqlQueryResult> {
  list($host, $port, $db, $user, $passwd) = \get_connection_info();
  // Cast because the array from get_connection_info() is a mixed
  $conn = await \AsyncMysqlClient::connect(
    (string) $host,
    (int) $port,
    (string) $db,
    (string) $user,
    (string) $passwd);
  return await $conn->query('SELECT * FROM test_table');
}

function run_it(): void {
  $res = \HH\Asio\join(do_connect());
  var_dump($res->numRows()); // The number of rows from the SELECT statement
}

run_it();
