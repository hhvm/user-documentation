<?hh

async function get_connection(): Awaitable<?AsyncMysqlConnection> {
  $conn = await AsyncMysqlClient::connect(
    'localhost', '3306', 'db', 'user', 'password'
  );
  return $conn;
}

async function fetch_user_name(AsyncMysqlConnection $conn,
                               int $user_id) : Awaitable<?string> {
  $result = await $conn->queryf('SELECT name from user_table WHERE id = %d',
                                $user_id);
  invariant($result->numRows() === 1, 'one row exactly');
  $vector = $result->vectorRows();
  return $vector[0];
}

async function async_mysql_tutorial(): Awaitable<void> {
  $conn = await get_connection();
  if ($conn !== null) {
    echo fetch_user_name($conn, 2);
  }
}

HH\Asio\join(async_mysql_tutorial());
