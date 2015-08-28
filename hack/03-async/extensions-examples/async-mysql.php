<?hh

namespace Hack\UserDocumentation\Async\Extensions\Examples\MySQL;

async function get_connection(): Awaitable<?\AsyncMysqlConnection> {
  // Change credentials to something that works in order to test this code
  return await \AsyncMysqlClient::connect(
    'localhost', 3306, 'db', 'user', 'password'
  );
}

async function fetch_user_name(\AsyncMysqlConnection $conn,
                               int $user_id) : Awaitable<?string> {
  // Your table and column may differ, of course
  $result = await $conn->queryf('SELECT name from user_table WHERE id = %d',
                                $user_id);
  invariant($result->numRows() === 1, 'one row exactly');
  // A vector of vector objects holding the string values of each column
  // in the query
  $vector = $result->vectorRows();
  return $vector[0][0]; // We had one column in our query
}

async function async_mysql_tutorial(): Awaitable<void> {
  $conn = await get_connection();
  if ($conn !== null) {
    $result = await fetch_user_name($conn, 2);
    echo $result . PHP_EOL;
  }
}

\HH\Asio\join(async_mysql_tutorial());
