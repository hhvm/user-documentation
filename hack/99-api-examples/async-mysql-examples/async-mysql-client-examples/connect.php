<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\AsyncMysqlClient\Conn;

require __DIR__ . "/../connect.inc";

async function do_connect(): Awaitable<\AsyncMysqlQueryResult> {
  list($host, $port, $db, $user, $passwd) = \get_connection_info();
  $conn = await \AsyncMysqlClient::connect(
    $host,
    $port,
    $db,
    $user,
    $passwd);
  return await $conn->query('SELECT * FROM test_table');
}

function run_it(): void {
  $res = \HH\Asio\join(do_connect());
  var_dump($res->numRows()); // The number of rows from the SELECT statement
}

run_it();
