<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql;

use Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function skipif_async(): Awaitable<void> {
  \init_docs_autoloader();

  $pool = new \AsyncMysqlConnectionPool(darray[]);
  try {
    await $pool->connect(CI::$host, CI::$port, CI::$db, CI::$user, CI::$passwd);
  } catch (\AsyncMysqlConnectException $_) {
    die('Skip');
  }
}
