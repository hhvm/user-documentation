<?hh

async function get_connection(): Awaitable<?AsyncMysqlConnection> {
  return await AsyncMysqlClient::connect(
    127.0.0.1, 3306, 'mydb', 'myuser', 'mypassword'
  );
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
  $conn = get_connection();
  if ($conn !== null) {
    echo fetch_user_name($conn, 22);
  }
}

HH\Asio\join(async_mysql_tutorial());
