This example shows how to take a synchronous MySQL connection and convert it to use an asynchronous MySQL connection via `AsyncMysqlClient::adoptConnection()`.

**NOTE**: Right now this does not work with `mysqli` or `PDO` connections.

```basic-usage.php
use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

function get_synchronous_connection(): resource {
  $conn = \mysql_connect(CI::$host, CI::$user, CI::$passwd);
  \mysql_select_db(CI::$db, $conn);
  return $conn;
}

function use_async_connection(resource $sync_conn): \AsyncMysqlConnection {
  return \AsyncMysqlClient::adoptConnection($sync_conn);
}

async function get_rows(
  \AsyncMysqlConnection $conn,
): Awaitable<\AsyncMysqlQueryResult> {
  return await $conn->query('SELECT * FROM test_table');
}

<<__EntryPoint>>
async function run_it(): Awaitable<void> {
  $sconn = get_synchronous_connection();
  $aconn = use_async_connection($sconn);
  $rows = await get_rows($aconn);
  \var_dump($rows->numRows()); // The number of rows from the SELECT statement
}
```.hhvm.expectf
int(%d)
```.example.hhvm.out
int(21)
```.skipif
<?hh

<<__EntryPoint>>
async function basic_usage_php_skipif_main(): Awaitable<void> {
  \init_docs_autoloader();
  await Hack\UserDocumentation\API\Examples\AsyncMysql\skipif_async();
}
```
