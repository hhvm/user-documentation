<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\Client\setPCL;

require __DIR__ . "/../connect.inc";

function set_connection_pool(): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool(array());
}

async function connect_with_pool(\AsyncMysqlConnectionPool $pool):
  Awaitable<\AsyncMysqlConnection> {
  list($host, $port, $db, $user, $passwd) = \get_connection_info();
  return await $pool->connect($host, $port, $db, $user, $passwd);
}

function get_stats(\AsyncMysqlConnectionPool $pool): array<mixed> {
  return $pool->getPoolStats();
}

function run_it(): void {
  \AsyncMysqlClient::setPoolsConnectionLimit(2);
  $pool = set_connection_pool();
  \HH\Asio\join(connect_with_pool($pool));
  \HH\Asio\join(connect_with_pool($pool));
  \HH\Asio\join(connect_with_pool($pool));
  var_dump(get_stats($pool));
}

run_it();
