<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassAsyncMysqlClientStatsMethodIoEventLoopMicrosAvg\BasicUsage;

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
async function get_loop_info(): Awaitable<?float> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $loop = $conn->connectResult()?->clientStats()?->ioEventLoopMicrosAvg();
  $conn->close();
  return $loop;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $l = await get_loop_info();
  \var_dump($l);
}
