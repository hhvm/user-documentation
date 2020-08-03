<?hh // partial

namespace Hack\UserDocumentation\AsyncOps\Extensions\Examples\AsyncMysql;

use \Hack\UserDocumentation\AsyncOps\Extensions\Examples\AsyncMysql\ConnectionInfo as CI
;

function async_mysql_skipif(): void {
  require __DIR__."/async_mysql_connect.inc.php";

  if (!\extension_loaded('mysql') || !\function_exists('mysqli_connect')) {
    die('Skip');
  }
  /* mysqli_connect never exists anymore
  if (!mysqli_connect(CI::$host, CI::$user, CI::$passwd, CI::$db, CI::$port)) {
    die('Skip');
  }
  */
}
