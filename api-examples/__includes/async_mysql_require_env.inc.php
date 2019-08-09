<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql;

require __DIR__."/async_mysql_connect.inc.php";

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

if (!extension_loaded('mysql') || !function_exists('mysqli_connect')) {
  die('Skip');
}
if (!mysqli_connect(CI::$host, CI::$user, CI::$passwd, CI::$db, CI::$port)) {
  die('Skip');
}
