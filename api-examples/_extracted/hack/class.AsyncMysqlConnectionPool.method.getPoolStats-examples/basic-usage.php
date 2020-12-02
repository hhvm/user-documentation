<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassAsyncMysqlConnectionPoolMethodGetPoolStats\BasicUsage;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;


function set_connection_pool(
  darray<string, mixed> $options = darray[],
): \AsyncMysqlConnectionPool {
  return new \AsyncMysqlConnectionPool($options);
}

async function connect_with_pool(
  \AsyncMysqlConnectionPool $pool,
): Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
}

function get_stats(\AsyncMysqlConnectionPool $pool): mixed {
  return $pool->getPoolStats();
}

<<__EntryPoint>>
async function run_it(): Awaitable<void> {
  \init_docs_autoloader();

  $pool = set_connection_pool();
  $conn_awaitables = Vector {};
  $conn_awaitables[] = connect_with_pool($pool);
  $conn_awaitables[] = connect_with_pool($pool);
  $conn_awaitables[] = connect_with_pool($pool);
  $conns = await \HH\Asio\v($conn_awaitables);
  // Get pool connection stats, like pool connections created, how many
  // connections were requested, etc.
  \var_dump(get_stats($pool));
}
