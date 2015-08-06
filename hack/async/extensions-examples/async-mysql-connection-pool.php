<?hh

function get_pool(): AsyncMysqlConnectionPool {
  return new AsyncMysqlConnectionPool(
    array('pool_connection_limit' => 100)
  ); // See API for more pool options
}

async function get_connection(): Awaitable<?AsyncMysqlConnection> {
  return await get_pool()->connect(
    127.0.0.1, 3306, 'mydb', 'myuser', 'mypassword'
  );
}

HH\Asio\join(get_connection());
