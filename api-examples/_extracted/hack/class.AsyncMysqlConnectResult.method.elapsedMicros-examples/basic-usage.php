<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassAsyncMysqlConnectResultMethodElapsedMicros\BasicUsage;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(
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
async function get_connection_time(): Awaitable<?int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $em = $conn->connectResult()?->elapsedMicros();
  $conn->close();
  return $em;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $em = await get_connection_time();
  \var_dump($em);
}
